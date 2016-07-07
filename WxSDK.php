<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 17:50
 */

namespace imxiangli\wxsdk;


use yii\base\Component;

class WxSDK extends Component
{
	public $appid;
	public $secret;
	public $token;
	public $encodingAESKey;
	public $encodingType = 0; //0:明文模式,2:加密模式
	public $accessTokenProvider;
	public $messageReceiver;

	/**
	 * @var Client
	 */
	public $client;

	public function init()
	{
		parent::init();
		$client = new Client();
		$client->appid = $this->appid;
		$client->secret = $this->secret;
		$client->token = $this->token;
		$client->encodingAESKey = $this->encodingAESKey;
		$client->accessTokenProvider = $this->accessTokenProvider;
		$client->messageReceiver = $this->messageReceiver;
		$client->encodingType = $this->encodingType;
		$this->client = $client;
	}
}