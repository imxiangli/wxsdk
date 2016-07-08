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
 * 获取标签下粉丝列表
 * Class GetTagUsers
 * @package imxiangli\wxapiclient\api
 */
class GetTagUsers extends Api
{
	public $access_token;
	public $tagid;
	public $next_openid;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
		if(isset($params['tagid']))
		{
			$this->tagid = $params['tagid'];
		}
		if(isset($params['next_openid']))
		{
			$this->next_openid = empty($params['next_openid']) ? '' : $params['next_openid'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/user/tag/get', [
			'query' => ['access_token' => $this->access_token],
			'body' => Json::encode([
				'tagid' => $this->tagid,
				'next_openid' => $this->next_openid,
			]),
		]);
		$response = new response\GetTagUsers();
		$this->processResponse($response, $rs);
		return $response;
	}
}