<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 15:57
 */

namespace imxiangli\wxsdk\api\response;


class GetCurrentSelfMenuInfo extends Response
{
	public $is_menu_open;
	public $selfmenu_info;

	public function init($data)
	{
		if(isset($data['is_menu_open']))
		{
			$this->is_menu_open = $data['is_menu_open'];
		}
		if(isset($data['selfmenu_info']))
		{
			$this->selfmenu_info = $data['selfmenu_info'];
		}
	}
}