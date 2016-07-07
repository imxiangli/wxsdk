<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class GetGroups extends Response
{
	public $groups;

	public function init($data)
	{
		if(isset($data['groups']))
		{
			$this->groups = $data['groups'];
		}
	}
}