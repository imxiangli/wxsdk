<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 16:23
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

class GetMedia extends Api
{
	public $access_token;
	public $media_id;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
		if(isset($params['media_id']))
		{
			$this->media_id = $params['media_id'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('GET', 'https://api.weixin.qq.com/cgi-bin/media/get', [
			'query' => ['access_token' => $this->access_token, 'media_id' => $this->media_id],
		]);
		$response = new response\GetMedia();
		$this->processResponse($response, $rs);
		return $response;
	}
}