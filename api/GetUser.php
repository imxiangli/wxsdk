<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 16:23
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

class GetUser extends Api
{
	public $access_token;
	public $next_openid;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
		if(isset($params['next_openid']))
		{
			$this->next_openid = $params['next_openid'];
		}
	}

	public function request()
	{
		$query = ['access_token' => $this->access_token];
		if(!empty($this->next_openid))
		{
			$query['next_openid'] = $this->next_openid;
		}
		$client = new Client();
		$rs = $client->request('GET', 'https://api.weixin.qq.com/cgi-bin/user/get', [
			'query' => $query,
		]);
		$response = new response\GetUser();
		$this->processResponse($response, $rs);
		return $response;
	}
}