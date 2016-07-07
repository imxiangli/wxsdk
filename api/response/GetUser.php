<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class GetUser extends Response
{
	public $total;
	public $count;
	public $data;
	public $next_openid;

	public function init($data)
	{
		if(isset($data['total']))
		{
			$this->total = $data['total'];
		}
		if(isset($data['count']))
		{
			$this->count = $data['count'];
		}
		if(isset($data['data']))
		{
			$this->data = $data['data'];
		}
		if(isset($data['next_openid']))
		{
			$this->next_openid = $data['next_openid'];
		}
	}
}