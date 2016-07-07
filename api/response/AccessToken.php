<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 15:57
 */

namespace imxiangli\wxsdk\api\response;


class AccessToken extends Response
{
	public $access_token;
	public $expires_in;

	public function init($data)
	{
		$this->setAccessToken($data['access_token']);
		$this->setExpiresIn($data['expires_in']);
	}

	/**
	 * @return mixed
	 */
	public function getAccessToken()
	{
		return $this->access_token;
	}

	/**
	 * @param mixed $access_token
	 */
	public function setAccessToken($access_token)
	{
		$this->access_token = $access_token;
	}

	/**
	 * @return mixed
	 */
	public function getExpiresIn()
	{
		return $this->expires_in;
	}

	/**
	 * @param mixed $expires_in
	 */
	public function setExpiresIn($expires_in)
	{
		$this->expires_in = $expires_in;
	}

}