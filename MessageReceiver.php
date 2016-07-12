<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/22
 * Time: 09:39
 */

namespace imxiangli\wxsdk;


use imxiangli\wxsdk\message\receive\ClickEventMessage;
use imxiangli\wxsdk\message\receive\ImageMessage;
use imxiangli\wxsdk\message\receive\LinkMessage;
use imxiangli\wxsdk\message\receive\LocationEventMessage;
use imxiangli\wxsdk\message\receive\LocationMessage;
use imxiangli\wxsdk\message\receive\Message;
use imxiangli\wxsdk\message\receive\QrsceneEventMessage;
use imxiangli\wxsdk\message\receive\ShortVideoMessage;
use imxiangli\wxsdk\message\receive\SubscribeEventMessage;
use imxiangli\wxsdk\message\receive\TextMessage;
use imxiangli\wxsdk\message\receive\VideoMessage;
use imxiangli\wxsdk\message\receive\ViewEventMessage;
use imxiangli\wxsdk\message\receive\VoiceMessage;

abstract class MessageReceiver
{
	public $encodingType = Client::ENCODING_TYPE_PLAINTEXT;
	public $token;
	public $encodingAesKey;
	public $appId;
	public $nonce;
	public $timeStamp;
	public $msg_signature;
	public $message;

	/**
	 * @return message\reply\Message
	 */
	abstract public function getReply();

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function getReplyXml()
	{
		$reply = $this->getReply();
		if(null == $reply) return '';
		$xml = $reply->toXml();
		if($this->encodingType == Client::ENCODING_TYPE_ENCRYPTION)
		{
			require_once dirname(__FILE__).'/wxBizMsgCrypt/wxBizMsgCrypt.php';
			$pc = new \WXBizMsgCrypt($this->token, $this->encodingAesKey, $this->appId);
			$encryptMsg = '';
			$errCode = $pc->encryptMsg($xml, $this->timeStamp, $this->nonce, $encryptMsg);
			if($errCode == 0)
				$xml = $encryptMsg;
			else
				throw new \Exception('encryptMsg error:'.$errCode, $errCode);
		}
		return $xml;
	}

	/**
	 * @param $str
	 * @return Message
	 * @throws \Exception
	 */
	public function convertMessage($str)
	{
		if($this->encodingType == Client::ENCODING_TYPE_ENCRYPTION)
		{
			require_once dirname(__FILE__).'/wxBizMsgCrypt/wxBizMsgCrypt.php';
			$pc = new \WXBizMsgCrypt($this->token, $this->encodingAesKey, $this->appId);
			$msg = '';
			$errCode = $pc->decryptMsg($this->msg_signature, $this->timeStamp, $this->nonce, $str, $msg);
			if($errCode == 0)
				$str = $msg;
			else
				throw new \Exception('decryptMsg error:'.$errCode, $errCode);
		}

		$xml = new \DOMDocument();
		$xml->loadXML($str);
		if($this->isTextMessage($xml))
		{
			$message = new TextMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isImageMessage($xml))
		{
			$message = new ImageMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isVoiceMessage($xml))
		{
			$message = new VoiceMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isVideoMessage($xml))
		{
			$message = new VideoMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isShortVideoMessage($xml))
		{
			$message = new ShortVideoMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isLocationMessage($xml))
		{
			$message = new LocationMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isLinkMessage($xml))
		{
			$message = new LinkMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isSubscribeEventMessage($xml))
		{
			$message = new SubscribeEventMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isQrsceneEventMessage($xml))
		{
			$message = new QrsceneEventMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isLocationEventMessage($xml))
		{
			$message = new LocationEventMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isClickEventMessage($xml))
		{
			$message = new ClickEventMessage();
			$message->fromXml($xml);
			return $message;
		}
		else if($this->isViewEventMessage($xml))
		{
			$message = new ViewEventMessage();
			$message->fromXml($xml);
			return $message;
		}

		return null;
	}

	/**
	 * @return mixed
	 */
	public function getEncodingType()
	{
		return $this->encodingType;
	}

	/**
	 * @param mixed $encodingType
	 */
	public function setEncodingType($encodingType)
	{
		$this->encodingType = $encodingType;
	}

	/**
	 * @return mixed
	 */
	public function getToken()
	{
		return $this->token;
	}

	/**
	 * @param mixed $token
	 */
	public function setToken($token)
	{
		$this->token = $token;
	}

	/**
	 * @return mixed
	 */
	public function getEncodingAesKey()
	{
		return $this->encodingAesKey;
	}

	/**
	 * @param mixed $encodingAesKey
	 */
	public function setEncodingAesKey($encodingAesKey)
	{
		$this->encodingAesKey = $encodingAesKey;
	}

	/**
	 * @return mixed
	 */
	public function getAppId()
	{
		return $this->appId;
	}

	/**
	 * @param mixed $appId
	 */
	public function setAppId($appId)
	{
		$this->appId = $appId;
	}

	/**
	 * @return mixed
	 */
	public function getNonce()
	{
		return $this->nonce;
	}

	/**
	 * @param mixed $nonce
	 */
	public function setNonce($nonce)
	{
		$this->nonce = $nonce;
	}

	/**
	 * @return mixed
	 */
	public function getTimeStamp()
	{
		return $this->timeStamp;
	}

	/**
	 * @param mixed $timeStamp
	 */
	public function setTimeStamp($timeStamp)
	{
		$this->timeStamp = $timeStamp;
	}

	/**
	 * @return mixed
	 */
	public function getMsgSignature()
	{
		return $this->msg_signature;
	}

	/**
	 * @param mixed $msg_signature
	 */
	public function setMsgSignature($msg_signature)
	{
		$this->msg_signature = $msg_signature;
	}

	/**
	 * @param \DOMDocument $xml
	 * @return bool
	 */
	public function isTextMessage(\DOMDocument $xml)
	{
		return $xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_TEXT;
	}

	public function isImageMessage(\DOMDocument $xml)
	{
		return $xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_IMAGE;
	}

	public function isVoiceMessage(\DOMDocument $xml)
	{
		return $xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_VOICE;
	}

	public function isVideoMessage(\DOMDocument $xml)
	{
		return $xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_VIDEO;
	}

	public function isShortVideoMessage(\DOMDocument $xml)
	{
		return $xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_SHORTVIDEO;
	}

	public function isLocationMessage(\DOMDocument $xml)
	{
		return $xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_LOCATION;
	}

	public function isLinkMessage(\DOMDocument $xml)
	{
		return $xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_LINK;
	}

	public function isSubscribeEventMessage(\DOMDocument $xml)
	{
		if($xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_EVENT)
		{
			$value = $xml->getElementsByTagName('Event')->item(0)->nodeValue;
			if(($value == 'subscribe' || $value == 'unsubscribe') && empty($xml->getElementsByTagName('EventKey')->item(0)->nodeValue))
			{
				return true;
			}
		}
		return false;
	}

	public function isQrsceneEventMessage(\DOMDocument $xml)
	{
		if($xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_EVENT)
		{
			$value = $xml->getElementsByTagName('Event')->item(0)->nodeValue;
			if($value == 'SCAN' || ($value == 'subscribe' && !empty($xml->getElementsByTagName('EventKey')->item(0)->nodeValue)))
			{
				return true;
			}
		}
		return false;
	}

	public function isLocationEventMessage(\DOMDocument $xml)
	{
		if($xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_EVENT)
		{
			$value = $xml->getElementsByTagName('Event')->item(0)->nodeValue;
			if($value == 'LOCATION')
			{
				return true;
			}
		}
		return false;
	}

	public function isClickEventMessage(\DOMDocument $xml)
	{
		if($xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_EVENT)
		{
			$value = $xml->getElementsByTagName('Event')->item(0)->nodeValue;
			if($value == 'CLICK')
			{
				return true;
			}
		}
		return false;
	}

	public function isViewEventMessage(\DOMDocument $xml)
	{
		if($xml->getElementsByTagName('MsgType')->item(0)->nodeValue == Message::TYPE_EVENT)
		{
			$value = $xml->getElementsByTagName('Event')->item(0)->nodeValue;
			if($value == 'VIEW')
			{
				return true;
			}
		}
		return false;
	}
}