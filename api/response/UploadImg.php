<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class UploadImg extends Response
{
	public $url;

	public function init($data)
	{
		if(isset($data['url']))
		{
			$this->url = $data['url'];
		}
	}
}