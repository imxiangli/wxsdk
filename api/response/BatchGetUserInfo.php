<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/25
 * Time: 15:34
 */

namespace imxiangli\wxsdk\api\response;


class BatchGetUserInfo extends Response
{
	/**
	 * @var UserInfo[]
	 */
	public $user_info_list;

	public function init($data)
	{
		if (isset($data['user_info_list'])) {
			foreach($data['user_info_list'] as $item)
			{
				$this->user_info_list[] = new UserInfo($item);
			}
		}
	}
}