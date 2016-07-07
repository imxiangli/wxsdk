<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 15:57
 */

namespace imxiangli\wxsdk\api\response;


class GetOAuth2AccessToken extends Response
{
	public $access_token;
	public $expires_in;
	public $refresh_token;
	public $openid;
	public $scope;

	public function init($data)
	{
		if(isset($data['access_token']))
		{
			$this->access_token = $data['access_token'];
		}
		if(isset($data['expires_in']))
		{
			$this->expires_in = $data['expires_in'];
		}
		if(isset($data['refresh_token']))
		{
			$this->refresh_token = $data['refresh_token'];
		}
		if(isset($data['openid']))
		{
			$this->openid = $data['openid'];
		}
		if(isset($data['scope']))
		{
			$this->scope = $data['scope'];
		}
	}
}