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
 * 修改永久图文素材
 * Class UpdateNewsMaterial
 * @package imxiangli\wxapiclient\api
 */
class UpdateNewsMaterial extends Api
{
	public $access_token;
	public $media_id;
	public $index;
	public $articles;

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
		if(isset($params['index']))
		{
			$this->index = $params['index'];
		}
		if(isset($params['articles']))
		{
			$this->articles = $params['articles'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/material/update_news', [
			'query' => ['access_token' => $this->access_token],
			'body' => Json::encode([
				'media_id' => $this->media_id,
				'index' => $this->index,
				'articles' => $this->articles,
			]),
		]);
		$response = new response\UpdateNewsMaterial();
		$this->processResponse($response, $rs);
		return $response;
	}
}