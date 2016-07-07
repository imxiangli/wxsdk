<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:26
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

class UploadMedia extends Api
{
	const TYPE_IMAGE = 'image';
	const TYPE_VOICE = 'voice';
	const TYPE_VIDEO = 'video';
	const TYPE_THUMB = 'thumb';

	public $access_token;
	public $type;
	public $media;
	public $filename;

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
		if(isset($params['media']))
		{
			$this->media = $params['media'];
		}
		if(isset($params['filename']))
		{
			$this->filename = $params['filename'];
		}
	}

	public function request()
	{
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/media/upload', [
			'query' => ['access_token' => $this->access_token, 'type' => $this->type],
			'multipart' => [
				[
					'name'     => 'media',
					'filename'     => $this->filename,
					'contents' => fopen($this->media, 'r')
				]
			],
		]);
		$response = new response\UploadMedia();
		$this->processResponse($response, $rs);
		return $response;
	}

	public static function getTypes()
	{
		return [
			self::TYPE_IMAGE => '图片',
			self::TYPE_VOICE => '语音',
			self::TYPE_VIDEO => '视频',
			self::TYPE_THUMB => '缩略图',
		];
	}
}