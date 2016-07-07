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


class GetMaterial extends Api
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
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/material/get_material', [
			'query' => ['access_token' => $this->access_token],
			'body' => Json::encode([
				'media_id' => $this->media_id
			])
		]);
		$response = new response\GetMaterial();
		$this->processResponse($response, $rs);
		return $response;
	}
}