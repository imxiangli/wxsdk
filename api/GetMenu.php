<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 16:23
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

class GetMenu extends Api
{
	public $access_token;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('GET', 'https://api.weixin.qq.com/cgi-bin/menu/get', [
			'query' => ['access_token' => $this->access_token],
		]);
		$response = new response\GetMenu();
		$this->processResponse($response, $rs);
		return $response;
	}
}