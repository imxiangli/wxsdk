<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 11:44
 */

namespace imxiangli\wxsdk;


interface AccessTokenProvider
{
	/**
	 * @param $appid
	 * @param $secret
	 * @param string $grant_type
	 * @return api\response\AccessToken|null
	 */
	public function getAccessToken($appid, $secret, $grant_type = 'client_credential');
}