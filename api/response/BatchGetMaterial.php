<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class BatchGetMaterial extends Response
{
	public $total_count;
	public $item_count;
	public $item;

	public function init($data)
	{
		if(isset($data['total_count']))
		{
			$this->total_count = $data['total_count'];
		}
		if(isset($data['item_count']))
		{
			$this->item_count = $data['item_count'];
		}
		if(isset($data['item']))
		{
			$this->item = $data['item'];
		}
	}
}