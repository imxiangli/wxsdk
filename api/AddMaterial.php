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
 * 新增其他永久素材
 * Class AddMaterial
 * @package imxiangli\wxapiclient\api
 */
class AddMaterial extends Api
{
	const TYPE_IMAGE = 'image';
	const TYPE_VOICE = 'voice';
	const TYPE_VIDEO = 'video';
	const TYPE_THUMB = 'thumb';

	public $access_token;
	public $type;
	public $media;
	public $filename;
	public $description;

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
		if(isset($params['description']))
		{
			$this->description = $params['description'];
		}
	}

	public function request()
	{
		$data = [
			[
				'name'     => 'media',
				'filename'     => $this->filename,
				'contents' => fopen($this->media, 'r')
			]
		];
		if($this->type == self::TYPE_VIDEO)
		{
			// {"title":"shaqingkneheheheheheheh", "introduction":"hehehehehheehehheheheheheheheheheh"}
			$data[] = [
				'name' => 'description',
				'contents' => $this->description
			];
		}
		$client = new Client();
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/material/add_material', [
			'query' => ['access_token' => $this->access_token, 'type' => $this->type],
			'multipart' => $data,
		]);
		$response = new response\AddMaterial();
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