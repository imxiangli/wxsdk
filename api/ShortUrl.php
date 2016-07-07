<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 14:17
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;
use yii\helpers\Json;

class ShortUrl extends Api
{
	public $access_token;
	public $long_url;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
		if(isset($params['long_url']))
		{
			$this->long_url = $params['long_url'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/shorturl', [
			'query' => ['access_token' => $this->access_token],
			'body' => Json::encode([
				'action' => 'long2short',
				'long_url' => $this->long_url,
			]),
		]);
		$response = new response\ShortUrl();
		$this->processResponse($response, $rs);
		return $response;
	}
}