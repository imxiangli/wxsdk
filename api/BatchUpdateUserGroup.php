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

class BatchUpdateUserGroup extends Api
{
	public $access_token;
	public $openid_list;
	public $to_groupid;

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
		if(isset($params['to_groupid']))
		{
			$this->to_groupid = $params['to_groupid'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate', [
			'query' => ['access_token' => $this->access_token],
			'body' => Json::encode([
				'openid_list' => Json::decode($this->openid_list),
				'to_groupid' => $this->to_groupid,
			]),
		]);
		$response = new response\BatchUpdateUserGroup();
		$this->processResponse($response, $rs);
		return $response;
	}
}