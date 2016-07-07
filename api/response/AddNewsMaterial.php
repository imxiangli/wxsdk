<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 15:57
 */

namespace imxiangli\wxsdk\api\response;


class AddNewsMaterial extends Response
{
	public $media_id;

	public function init($data)
	{
		if(isset($data['media_id']))
		{
			$this->media_id = $data['media_id'];
		}
	}
}