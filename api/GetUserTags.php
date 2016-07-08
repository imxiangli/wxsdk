<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 16:23
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;
use yii\helpers\Json;

class GetUserTags extends Api
{
	public $access_token;
	public $openid;

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
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/tags/getidlist', [
			'query' => ['access_token' => $this->access_token],
			'body' => Json::encode([
				'openid' => $this->openid
			])
		]);
		$response = new response\GetUserTags();
		$this->processResponse($response, $rs);
		return $response;
	}
}