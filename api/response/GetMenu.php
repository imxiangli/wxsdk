<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 15:57
 */

namespace imxiangli\wxsdk\api\response;


class GetMenu extends Response
{
	public $menu;
	public $conditionalmenu;

	public function init($data)
	{
		if(isset($data['menu']))
		{
			$this->menu = $data['menu'];
		}
		if(isset($data['conditionalmenu']))
		{
			$this->conditionalmenu = $data['conditionalmenu'];
		}
	}
}