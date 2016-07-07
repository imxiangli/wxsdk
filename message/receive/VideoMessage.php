<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 08:20
 */

namespace imxiangli\wxsdk\message\receive;


class VideoMessage extends Message
{
	public $mediaId;
	public $thumbMediaId;
	public $msgId;

	public function setMessageData(\DOMDocument $xml)
	{
		$this->setMediaId($xml->getElementsByTagName('MediaId')->item(0)->nodeValue);
		$this->setThumbMediaId($xml->getElementsByTagName('ThumbMediaId')->item(0)->nodeValue);
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
	public function getThumbMediaId()
	{
		return $this->thumbMediaId;
	}

	/**
	 * @param mixed $thumbMediaId
	 */
	public function setThumbMediaId($thumbMediaId)
	{
		$this->thumbMediaId = $thumbMediaId;
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