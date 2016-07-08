<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class GetTags extends Response
{
	public $tags;

	public function init($data)
	{
		if(isset($data['tags']))
		{
			$this->tags = $data['tags'];
		}
	}
}