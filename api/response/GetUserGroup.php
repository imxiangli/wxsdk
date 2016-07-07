<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class GetUserGroup extends Response
{
	public $groupid;

	public function init($data)
	{
		if(isset($data['groupid']))
		{
			$this->groupid = $data['groupid'];
		}
	}
}