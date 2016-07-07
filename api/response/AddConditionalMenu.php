<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/22
 * Time: 09:00
 */

namespace imxiangli\wxsdk\api\response;


class AddConditionalMenu extends Response
{
	public $menuid;
	public function init($data)
	{
		if(isset($data['menuid']))
		{
			$this->menuid = $data['menuid'];
		}
	}
}