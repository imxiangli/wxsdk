<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class GetTagUsers extends Response
{
	public $count;
	public $data;
	public $next_openid;

	public function init($data)
	{
		if(isset($data['count']))
		{
			$this->count = $data['count'];
		}
		if(isset($data['data']['openid']))
		{
			$this->data = $data['data']['openid'];
		}
		if(isset($data['next_openid']))
		{
			$this->next_openid = $data['next_openid'];
		}
	}
}