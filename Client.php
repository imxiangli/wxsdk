<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 11:12
 */

namespace imxiangli\wxsdk;


use imxiangli\wxsdk\api\AddConditionalMenu;
use imxiangli\wxsdk\api\AddMaterial;
use imxiangli\wxsdk\api\AddNewsMaterial;
use imxiangli\wxsdk\api\BatchGetMaterial;
use imxiangli\wxsdk\api\BatchGetUserInfo;
use imxiangli\wxsdk\api\BatchTaggingUser;
use imxiangli\wxsdk\api\BatchUntaggingUser;
use imxiangli\wxsdk\api\CreateMenu;
use imxiangli\wxsdk\api\CreateQrcode;
use imxiangli\wxsdk\api\CreateTag;
use imxiangli\wxsdk\api\DeleteMaterial;
use imxiangli\wxsdk\api\DeleteMenu;
use imxiangli\wxsdk\api\DeleteTag;
use imxiangli\wxsdk\api\GetCurrentSelfMenuInfo;
use imxiangli\wxsdk\api\GetMaterial;
use imxiangli\wxsdk\api\GetMaterialCount;
use imxiangli\wxsdk\api\GetMedia;
use imxiangli\wxsdk\api\GetMenu;
use imxiangli\wxsdk\api\GetOAuth2AccessToken;
use imxiangli\wxsdk\api\GetTags;
use imxiangli\wxsdk\api\GetTagUsers;
use imxiangli\wxsdk\api\GetUser;
use imxiangli\wxsdk\api\GetUserTags;
use imxiangli\wxsdk\api\ShortUrl;
use imxiangli\wxsdk\api\UpdateNewsMaterial;
use imxiangli\wxsdk\api\UpdateTag;
use imxiangli\wxsdk\api\UpdateUserRemark;
use imxiangli\wxsdk\api\UploadImg;
use imxiangli\wxsdk\api\UploadMedia;
use imxiangli\wxsdk\api\UserInfo;

class Client
{
	const ENCODING_TYPE_PLAINTEXT = 0;
	const ENCODING_TYPE_ENCRYPTION = 2;

	public $appid;
	public $secret;
	public $token;
	public $encodingAESKey;
	public $encodingType = 0; //0:明文模式,2:加密模式

	/**
	 * 接收消息并返回响应消息
	 * @param MessageReceiver $messageReceiver
	 * @param $timestamp
	 * @param $timestamp
	 * @param $nonce
	 * @param $msg_signature
	 */
	public function receiveMessage($messageReceiver, $data, $timestamp, $nonce, $msg_signature)
	{
		$messageReceiver->setEncodingType($this->encodingType);
		$messageReceiver->setEncodingAesKey($this->encodingAESKey);
		$messageReceiver->setToken($this->token);
		$messageReceiver->setAppId($this->appid);
		$messageReceiver->setNonce($nonce);
		$messageReceiver->setMsgSignature($msg_signature);
		$messageReceiver->setTimeStamp($timestamp);
	}

	/**
	 * @var AccessTokenProvider
	 */
	public $accessTokenProvider;

	/**
	 * 创建自定义菜单
	 * @param string $menu json字符串
	 * @return api\response\CreateMenu|null
	 */
	public function createMenu($menu)
	{
		$api = new CreateMenu();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'menu_data' => $menu,
		]);
		return $api->request();
	}

	/**
	 * 创建个性化自定义菜单
	 * @param string $menu json字符串
	 * @return api\response\AddConditionalMenu|null
	 */
	public function addConditionalMenu($menu)
	{
		$api = new AddConditionalMenu();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'menu_data' => $menu,
		]);
		return $api->request();
	}

	public function deleteMenu()
	{
		$api = new DeleteMenu();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
		]);
		return $api->request();
	}

	public function getMenu()
	{
		$api = new GetMenu();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
		]);
		return $api->request();
	}

	public function getCurrentSelfMenuInfo()
	{
		$api = new GetCurrentSelfMenuInfo();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
		]);
		return $api->request();
	}

	/**
	 * 创建临时二维码
	 * @param string $scene
	 * @param int $expire_seconds
	 * @return api\response\CreateQrcode|null
	 */
	public function createTempQrcode($scene, $expire_seconds = 604800)
	{
		$api = new CreateQrcode();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'action_name' => CreateQrcode::ACTION_NAME_QR_SCENE,
			'expire_seconds' => $expire_seconds,
			'scene_str' => (string)$scene,
		]);
		return $api->request();
	}

	/**
	 * 创建永久二维码
	 * @param string $scene
	 * @return api\response\CreateQrcode|null
	 */
	public function createLimitQrcode($scene)
	{
		$api = new CreateQrcode();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'action_name' => CreateQrcode::ACTION_NAME_QR_LIMIT_STR_SCENE,
			'scene_str' => (string)$scene,
		]);
		return $api->request();
	}

	/**
	 * 短连接转换
	 * @param $longUrl
	 * @return api\response\ShortUrl
	 */
	public function shortUrl($longUrl)
	{
		$api = new ShortUrl();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'long_url' => $longUrl,
		]);
		return $api->request();
	}

	/**
	 * 新增永久图文素材
	 * @param $news
	 * @return api\response\AddNewsMaterial
	 */
	public function addNewsMaterial($news)
	{
		$api = new AddNewsMaterial();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'news' => $news,
		]);
		return $api->request();
	}

	public function uploadImg($media_file, $filename)
	{
		$api = new UploadImg();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'media' => $media_file,
			'filename' => $filename,
		]);
		return $api->request();
	}

	/**
	 * 新增永久图文素材
	 * @param $media_id
	 * @param $index
	 * @param $articles
	 * @return api\response\UpdateNewsMaterial
	 */
	public function updateNewsMaterial($media_id, $index, $articles)
	{
		$api = new UpdateNewsMaterial();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'media_id' => $media_id,
			'index' => $index,
			'articles' => $articles,
		]);
		return $api->request();
	}

	/**
	 * 上传临时素材
	 * @param $media_file
	 * @param $filename
	 * @param string $type UploadMedia::TYPE_IMAGE || UploadMedia::TYPE_VOICE || UploadMedia::TYPE_VIDEO || UploadMedia::TYPE_THUMB
	 * @return api\response\UploadMedia
	 */
	public function uploadMedia($media_file, $filename, $type)
	{
		$api = new UploadMedia();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'media' => $media_file,
			'type' => $type,
			'filename' => $filename,
		]);
		return $api->request();
	}

	public function getMedia($media_id)
	{
		$api = new GetMedia();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'media_id' => (string)$media_id,
		]);
		return $api->request();
	}

	/**
	 * 新增其他永久素材
	 * @param $media_file
	 * @param $filename
	 * @param string $video_description json字符串包含title和introduction字段
	 * @param string $type AddMaterial::TYPE_IMAGE || AddMaterial::TYPE_VOICE || AddMaterial::TYPE_VIDEO || AddMaterial::TYPE_THUMB
	 * @return api\response\AddMaterial
	 */
	public function addMaterial($media_file, $filename, $type, $video_description = null)
	{
		$api = new AddMaterial();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'media' => $media_file,
			'type' => $type,
			'filename' => $filename,
			'description' => $video_description,
		]);
		return $api->request();
	}

	public function deleteMaterial($media_id)
	{
		$api = new DeleteMaterial();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'media_id' => $media_id,
		]);
		return $api->request();
	}

	public function getMaterialCount()
	{
		$api = new GetMaterialCount();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
		]);
		return $api->request();
	}

	public function batchGetMaterial($type, $offset = 0, $count = 20)
	{
		$api = new BatchGetMaterial();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'type' => $type,
			'offset' => $offset,
			'count' => $count,
		]);
		return $api->request();
	}

	public function getMaterial($media_id)
	{
		$api = new GetMaterial();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'media_id' => $media_id,
		]);
		return $api->request();
	}

	public function getUser($next_openid = null)
	{
		$api = new GetUser();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'next_openid' => $next_openid,
		]);
		return $api->request();
	}

	public function updateUserRemark($openid, $remark)
	{
		$api = new UpdateUserRemark();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'openid' => $openid,
			'remark' => $remark,
		]);
		return $api->request();
	}

	public function userInfo($openid, $lang = null)
	{
		$api = new UserInfo();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'openid' => $openid,
			'lang' => $lang,
		]);
		return $api->request();
	}

	public function batchGetUserInfo($user_list)
	{
		$api = new BatchGetUserInfo();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'user_list' => $user_list,
		]);
		return $api->request();
	}

	public function createTag($name)
	{
		$api = new CreateTag();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'name' => $name,
		]);
		return $api->request();
	}

	public function updateTag($id, $name)
	{
		$api = new UpdateTag();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'id' => $id,
			'name' => $name,
		]);
		return $api->request();
	}

	public function deleteTag($id)
	{
		$api = new DeleteTag();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'id' => $id,
		]);
		return $api->request();
	}

	public function getTagUsers($tagid, $next_openid = null)
	{
		$api = new GetTagUsers();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'tagid' => $tagid,
			'next_openid' => $next_openid,
		]);
		return $api->request();
	}

	public function batchTaggingUser($openid_list, $tagid)
	{
		$api = new BatchTaggingUser();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'openid_list' => $openid_list,
			'tagid' => $tagid,
		]);
		return $api->request();
	}

	public function batchUntaggingUser($openid_list, $tagid)
	{
		$api = new BatchUntaggingUser();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'openid_list' => $openid_list,
			'tagid' => $tagid,
		]);
		return $api->request();
	}

	public function getTags()
	{
		$api = new GetTags();
		$api->setParams([
			'access_token' => $this->getAccessToken()
		]);
		return $api->request();
	}

	public function getUserTags($openid)
	{
		$api = new GetUserTags();
		$api->setParams([
			'access_token' => $this->getAccessToken(),
			'openid' => $openid,
		]);
		return $api->request();
	}

	/**
	 * 微信服务器签名检查
	 * @param $signature
	 * @param $timestamp
	 * @param $nonce
	 * @return bool
	 */
	public function checkSignature($signature, $timestamp, $nonce)
	{
		$tmpArr = array($this->token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

	public function getOAuth2AccessToken($code, $grant_type = 'authorization_code')
	{
		$api = new GetOAuth2AccessToken();
		$api->setParams([
			'appid' => $this->appid,
			'secret' => $this->secret,
			'code' => $code,
			'grant_type' => $grant_type,
		]);
		return $api->request();
	}

	/**
	 * @param $redirect_uri
	 * @param string $state
	 * @param string $scope 可传 snsapi_base 或 snsapi_userinfo
	 * @param string $response_type
	 * @return string
	 */
	public function oAuth2GetCodeUrl($redirect_uri, $state = '', $scope = 'snsapi_base', $response_type = 'code')
	{
		$format = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=%s&scope=%s&state=%s#wechat_redirect';
		return sprintf($format, $this->appid, urlencode($redirect_uri), $response_type, $scope, $state);
	}

	private function getAccessToken()
	{
		$accessToken = $this->accessTokenProvider->getAccessToken($this->appid, $this->secret);
		if(null != $accessToken) return $accessToken->getAccessToken();
		return null;
	}
}