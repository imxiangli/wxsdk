<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class CreateGroup extends Response
{
	public $id;
	public $name;

	public function init($data)
	{
		if(isset($data['group']['id']))
		{
			$this->id = $data['group']['id'];
		}
		if(isset($data['group']['name']))
		{
			$this->name = $data['group']['name'];
		}
	}
}