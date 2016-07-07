<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 08:15
 */

namespace imxiangli\wxsdk\message\receive;


class ImageMessage extends Message
{
	public $picUrl;
	public $mediaId;
	public $msgId;

	public function setMessageData(\DOMDocument $xml)
	{
		$this->setPicUrl($xml->getElementsByTagName('PicUrl')->item(0)->nodeValue);
		$this->setMediaId($xml->getElementsByTagName('MediaId')->item(0)->nodeValue);
		$this->setMsgId($xml->getElementsByTagName('MsgId')->item(0)->nodeValue);
	}

	/**
	 * @return mixed
	 */
	public function getPicUrl()
	{
		return $this->picUrl;
	}

	/**
	 * @param mixed $picUrl
	 */
	public function setPicUrl($picUrl)
	{
		$this->picUrl = $picUrl;
	}

	/**
	 * @return mixed
	 */
	public function getMediaId()
	{
		return $this->mediaId;
	}

	/**
	 * @param mixed $mediaId
	 */
	public function setMediaId($mediaId)
	{
		$this->mediaId = $mediaId;
	}

	/**
	 * @return mixed
	 */
	public function getMsgId()
	{
		return $this->msgId;
	}

	/**
	 * @param mixed $msgId
	 */
	public function setMsgId($msgId)
	{
		$this->msgId = $msgId;
	}
}