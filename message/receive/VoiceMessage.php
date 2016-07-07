<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 08:18
 */

namespace imxiangli\wxsdk\message\receive;


class VoiceMessage extends Message
{
	public $mediaId;
	public $format;
	public $msgId;

	public function setMessageData(\DOMDocument $xml)
	{
		$this->setMediaId($xml->getElementsByTagName('MediaId')->item(0)->nodeValue);
		$this->setFormat($xml->getElementsByTagName('Format')->item(0)->nodeValue);
		$this->setMsgId($xml->getElementsByTagName('MsgId')->item(0)->nodeValue);
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
	public function getFormat()
	{
		return $this->format;
	}

	/**
	 * @param mixed $format
	 */
	public function setFormat($format)
	{
		$this->format = $format;
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