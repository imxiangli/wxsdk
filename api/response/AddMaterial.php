<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class AddMaterial extends Response
{
	public $media_id;
	public $url;

	public function init($data)
	{
		if(isset($data['media_id']))
		{
			$this->media_id = $data['media_id'];
		}
		if(isset($data['url']))
		{
			$this->url = $data['url'];
		}
	}
}