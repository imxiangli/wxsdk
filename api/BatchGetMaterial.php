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

/**
 * 获取素材列表
 * Class BatchGetMaterial
 * @package imxiangli\wxapiclient\api
 */
class BatchGetMaterial extends Api
{
	public $access_token;
	public $type;
	public $offset = 0;
	public $count = 20;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
		if(isset($params['type']))
		{
			$this->type = $params['type'];
		}
		if(isset($params['offset']))
		{
			$this->offset = $params['offset'];
		}
		if(isset($params['count']))
		{
			$this->count = $params['count'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/material/batchget_material', [
			'query' => ['access_token' => $this->access_token, 'type' => $this->type],
			'body' => Json::encode([
				'type' => $this->type,
				'offset' => $this->offset,
				'count' => $this->count,
			]),
		]);
		$response = new response\BatchGetMaterial();
		$this->processResponse($response, $rs);
		return $response;
	}
}