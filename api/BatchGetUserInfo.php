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

class BatchGetUserInfo extends Api
{
	public $access_token;
	public $user_list;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
		if(isset($params['user_list']))
		{
			$this->user_list = $params['user_list'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/user/info/batchget', [
			'query' => ['access_token' => $this->access_token],
			'body' => Json::encode([
				'user_list' => Json::decode($this->user_list)
			]),
		]);
		$response = new response\BatchGetUserInfo();
		$this->processResponse($response, $rs);
		return $response;
	}
}