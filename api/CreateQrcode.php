<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 16:23
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

class CreateQrcode extends Api
{
	const ACTION_NAME_QR_SCENE = 'QR_SCENE';
	const ACTION_NAME_QR_LIMIT_SCENE = 'QR_LIMIT_SCENE';
	const ACTION_NAME_QR_LIMIT_STR_SCENE = 'QR_LIMIT_STR_SCENE';

	public $access_token;
	public $expire_seconds;
	public $action_name;
	public $scene_id;
	public $scene_str;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
		}
		if(isset($params['expire_seconds']))
		{
			$this->expire_seconds = $params['expire_seconds'];
		}
		if(isset($params['action_name']))
		{
			$this->action_name = $params['action_name'];
		}
		if(isset($params['scene_id']))
		{
			$this->scene_id = $params['scene_id'];
		}
		if(isset($params['scene_str']))
		{
			$this->scene_str = $params['scene_str'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/qrcode/create', [
			'query' => ['access_token' => $this->access_token],
			'body' => $this->generateRequestData(),
		]);
		$response = new response\CreateQrcode();
		$this->processResponse($response, $rs);
		return $response;
	}

	private function generateRequestData()
	{
		if($this->action_name == self::ACTION_NAME_QR_SCENE) // 临时二维码
		{
			// {"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}
			return json_encode([
				'expire_seconds' => (int)$this->expire_seconds,
				'action_name' => $this->action_name,
				'action_info' => [
					'scene' => [
						'scene_id' => $this->scene_id,
					],
				],
			]);
		}
		else if($this->action_name == self::ACTION_NAME_QR_SCENE) // 永久二维码
		{
			// {"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}
			return json_encode([
				'action_name' => $this->action_name,
				'action_info' => [
					'scene' => [
						'scene_id' => $this->scene_id,
					],
				],
			]);
		}
		else if($this->action_name == self::ACTION_NAME_QR_LIMIT_STR_SCENE) // 永久二维码
		{
			// {"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "123"}}}
			return json_encode([
				'action_name' => $this->action_name,
				'action_info' => [
					'scene' => [
						'scene_str' => $this->scene_str,
					],
				],
			]);
		}
	}
}