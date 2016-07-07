<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/25
 * Time: 14:36
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;
use yii\helpers\Json;

class UpdateUserRemark extends Api
{
	public $access_token;
	public $openid;
	public $remark;

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
		if(isset($params['remark']))
		{
			$this->remark = $params['remark'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark', [
			'query' => ['access_token' => $this->access_token],
			'body' => Json::encode([
				'openid' => $this->openid,
				'remark' => $this->remark,
			]),
		]);
		$response = new response\UpdateUserRemark();
		$this->processResponse($response, $rs);
		return $response;
	}
}