<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 11:50
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

class GetOAuth2AccessToken extends Api
{
	private $appid;
	private $secret;
	private $code;
	private $grant_type = 'authorization_code';

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
		if(isset($params['code']))
		{
			$this->code = $params['code'];
		}
		if(isset($params['grant_type']))
		{
			$this->grant_type = $params['grant_type'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('GET', 'https://api.weixin.qq.com/sns/oauth2/access_token', [
			'query' => [
				'appid' => $this->appid,
				'secret' => $this->secret,
				'code' => $this->code,
				'grant_type' => $this->grant_type,
			]
		]);
		$response = new response\GetOAuth2AccessToken();
		$this->processResponse($response, $rs);
		return $response;
	}
}