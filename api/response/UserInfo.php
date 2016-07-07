<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/25
 * Time: 15:34
 */

namespace imxiangli\wxsdk\api\response;


class UserInfo extends Response
{
	public $subscribe;
	public $openid;
	public $nickname;
	public $sex;
	public $language;
	public $city;
	public $province;
	public $country;
	public $headimgurl;
	public $subscribe_time;
	public $unionid;
	public $remark;
	public $groupid;

	public function init($data)
	{
		if (isset($data['subscribe'])) {
			$this->subscribe = $data['subscribe'];
		}
		if (isset($data['openid'])) {
			$this->openid = $data['openid'];
		}
		if (isset($data['nickname'])) {
			$this->nickname = $data['nickname'];
		}
		if (isset($data['sex'])) {
			$this->sex = $data['sex'];
		}
		if (isset($data['language'])) {
			$this->language = $data['language'];
		}
		if (isset($data['city'])) {
			$this->city = $data['city'];
		}
		if (isset($data['province'])) {
			$this->province = $data['province'];
		}
		if (isset($data['country'])) {
			$this->country = $data['country'];
		}
		if (isset($data['headimgurl'])) {
			$this->headimgurl = $data['headimgurl'];
		}
		if (isset($data['subscribe_time'])) {
			$this->subscribe_time = $data['subscribe_time'];
		}
		if (isset($data['unionid'])) {
			$this->unionid = $data['unionid'];
		}
		if (isset($data['remark'])) {
			$this->remark = $data['remark'];
		}
		if (isset($data['groupid'])) {
			$this->groupid = $data['groupid'];
		}
	}
}