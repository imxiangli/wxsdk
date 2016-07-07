<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 16:23
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

/**
 * 获取永久素材总数
 * Class GetMaterialCount
 * @package imxiangli\wxapiclient\api
 */
class GetMaterialCount extends Api
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
		$rs = $client->request('GET', 'https://api.weixin.qq.com/cgi-bin/material/get_materialcount', [
			'query' => ['access_token' => $this->access_token,],
		]);
		$response = new response\GetMaterialCount();
		$this->processResponse($response, $rs);
		return $response;
	}
}