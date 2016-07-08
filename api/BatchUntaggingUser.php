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

class BatchUntaggingUser extends Api
{
	public $access_token;
	public $openid_list;
	public $tagid;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
		if(isset($params['openid_list']))
		{
			$this->openid_list = $params['openid_list'];
		}
		if(isset($params['tagid']))
		{
			$this->tagid = $params['tagid'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging', [
			'query' => ['access_token' => $this->access_token],
			'body' => Json::encode([
				'openid_list' => $this->openid_list,
				'tagid' => $this->tagid,
			]),
		]);
		$response = new response\BatchUntaggingUser();
		$this->processResponse($response, $rs);
		return $response;
	}
}