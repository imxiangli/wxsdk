<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class CreateTag extends Response
{
	public $id;
	public $name;

	public function init($data)
	{
		if(isset($data['tag']['id']))
		{
			$this->id = $data['tag']['id'];
		}
		if(isset($data['tag']['name']))
		{
			$this->name = $data['tag']['name'];
		}
	}
}