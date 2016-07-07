<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 16:23
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

class UserInfo extends Api
{
	const LONG_ZH_CN = 'zh_CN';
	const LONG_ZH_TW = 'zh_TW';
	const LONG_EN = 'en';

	public $access_token;
	public $openid;
	public $lang;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
		if(isset($params['openid']))
		{
			$this->openid = $params['openid'];
		}
		if(isset($params['lang']))
		{
			$this->lang = $params['lang'];
		}
	}

	public function request()
	{
		$query = ['access_token' => $this->access_token, 'openid' => $this->openid];
		if(!empty($this->lang))
		{
			$query['lang'] = $this->lang;
		}
		$client = new Client();
		$rs = $client->request('GET', 'https://api.weixin.qq.com/cgi-bin/user/info', [
			'query' => $query,
		]);
		$response = new response\UserInfo();
		$this->processResponse($response, $rs);
		return $response;
	}
}