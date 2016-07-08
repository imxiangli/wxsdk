<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class GetUserTags extends Response
{
	public $tagid_list;

	public function init($data)
	{
		if(isset($data['tagid_list']))
		{
			$this->tagid_list = $data['tagid_list'];
		}
	}
}