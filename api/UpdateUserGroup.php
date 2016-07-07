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

class UpdateUserGroup extends Api
{
	public $access_token;
	public $openid;
	public $to_groupid;

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
				'openid' => $this->openid,
				'to_groupid' => $this->to_groupid,
			]),
		]);
		$response = new response\UpdateUserGroup();
		$this->processResponse($response, $rs);
		return $response;
	}
}