<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 15:57
 */

namespace imxiangli\wxsdk\api\response;


class ShortUrl extends Response
{
	public $short_url;

	public function init($data)
	{
		if(isset($data['short_url']))
		{
			$this->short_url = $data['short_url'];
		}
	}
}