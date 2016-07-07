<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 11:50
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

class GetAccessToken extends Api
{
	private $appid;
	private $secret;
	private $grant_type = 'client_credential';

	public function setParams($params)
	{
		if(isset($params['appid']))
		{
			$this->appid = $params['appid'];
		}
		if(isset($params['secret']))
		{
			$this->secret = $params['secret'];
		}
		if(isset($params['grant_type']))
		{
			$this->grant_type = $params['grant_type'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('GET', 'https://api.weixin.qq.com/cgi-bin/token', [
			'query' => [
				'grant_type' => $this->grant_type,
				'appid' => $this->appid,
				'secret' => $this->secret,
			]
		]);
		$response = new response\AccessToken();
		$this->processResponse($response, $rs);
		return $response;
	}
}