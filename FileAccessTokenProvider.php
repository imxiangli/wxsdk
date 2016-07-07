<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 16:12
 */

namespace imxiangli\wxsdk;


use imxiangli\wxsdk\api\GetAccessToken;

class FileAccessTokenProvider implements AccessTokenProvider
{
	public function getAccessToken($appid, $secret, $grant_type = 'client_credential')
	{
		$key = 'wx-access-token-'.$appid;
		$obj = $this->read($key);
		if(null == $obj)
		{
			$api = new GetAccessToken();
			$api->setParams(array(
				'appid' => $appid,
				'secret' => $secret,
				'grant_type' => $grant_type
			));
			$obj = $api->request();
			if(null != $obj && !$obj->apiError)
			{
				$this->write($key, $obj);
			}
		}
		return $obj;
	}

	private function write($key, $value)
	{
		file_put_contents($this->getStoreFile(md5($key)), serialize($value).time());
	}

	private function read($key)
	{
		$file = $this->getStoreFile(md5($key));
		if(!file_exists($this->getStoreFile(md5($key))))
			return null;
		$content = file_get_contents($file);
		/** @var api\response\AccessToken $obj */
		$obj = @unserialize(substr($content, 0, -10));
		if(!$obj || time() > ($obj->expires_in+(int)substr($content, -10)))
			return null;
		return $obj;
	}

	private function getStoreFile($key)
	{
		return dirname(__FILE__).'/data/'.$key;
	}
}