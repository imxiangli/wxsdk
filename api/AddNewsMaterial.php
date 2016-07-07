<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 16:23
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

/**
 * 新增永久图文素材
 * Class AddNewsMaterial
 * @package imxiangli\wxapiclient\api
 */
class AddNewsMaterial extends Api
{
	public $access_token;
	public $news;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
		if(isset($params['news']))
		{
			$this->news = $params['news'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/material/add_news', [
			'query' => ['access_token' => $this->access_token],
			'body' => $this->news,
		]);
		$response = new response\AddNewsMaterial();
		$this->processResponse($response, $rs);
		return $response;
	}
}