<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class UploadMedia extends Response
{
	public $type;
	public $media_id;
	public $created_at;

	public function init($data)
	{
		if(isset($data['type']))
		{
			$this->type = $data['type'];
		}
		if(isset($data['media_id']))
		{
			$this->media_id = $data['media_id'];
		}
		if(isset($data['created_at']))
		{
			$this->created_at = $data['created_at'];
		}
	}
}