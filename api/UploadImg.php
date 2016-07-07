<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:26
 */

namespace imxiangli\wxsdk\api;


use GuzzleHttp\Client;

class UploadImg extends Api
{
	public $access_token;
	public $media;
	public $filename;

	public function setParams($params)
	{
		if(isset($params['access_token']))
		{
			$this->access_token = $params['access_token'];
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
		$rs = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/media/uploadimg', [
			'query' => ['access_token' => $this->access_token],
			'multipart' => [
				[
					'name'     => 'media',
					'filename'     => $this->filename,
					'contents' => fopen($this->media, 'r')
				]
			],
		]);
		$response = new response\UploadImg();
		$this->processResponse($response, $rs);
		return $response;
	}
}