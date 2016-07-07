<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/22
 * Time: 09:40
 */

namespace imxiangli\wxsdk\message\receive;

abstract class Message
{
	const TYPE_TEXT = 'text';
	const TYPE_IMAGE = 'image';
	const TYPE_VOICE = 'voice';
	const TYPE_VIDEO = 'video';
	const TYPE_SHORTVIDEO = 'shortvideo';
	const TYPE_LOCATION = 'location';
	const TYPE_LINK = 'link';
	const TYPE_EVENT = 'event';

	public $toUserName;
	public $fromUserName;
	public $createTime;
	public $msgType;

	/**
	 * @return mixed
	 */
	public function getToUserName()
	{
		return $this->toUserName;
	}

	/**
	 * @param mixed $toUserName
	 */
	public function setToUserName($toUserName)
	{
		$this->toUserName = $toUserName;
	}

	/**
	 * @return mixed
	 */
	public function getFromUserName()
	{
		return $this->fromUserName;
	}

	/**
	 * @param mixed $fromUserName
	 */
	public function setFromUserName($fromUserName)
	{
		$this->fromUserName = $fromUserName;
	}

	/**
	 * @return mixed
	 */
	public function getCreateTime()
	{
		return $this->createTime;
	}

	/**
	 * @param mixed $createTime
	 */
	public function setCreateTime($createTime)
	{
		$this->createTime = $createTime;
	}

	/**
	 * @return mixed
	 */
	public function getMsgType()
	{
		return $this->msgType;
	}

	/**
	 * @param mixed $msgType
	 */
	public function setMsgType($msgType)
	{
		$this->msgType = $msgType;
	}

	/**
	 * @param $str
	 * @return Message
	 */
	public function fromString($str)
	{
		$xml = new \DOMDocument();
		$xml->loadXML($str);
		$this->fromXml($xml);
	}

	public function fromXml(\DOMDocument $xml)
	{
		$this->setToUserName($xml->getElementsByTagName('ToUserName')->item(0)->nodeValue);
		$this->setFromUserName($xml->getElementsByTagName('FromUserName')->item(0)->nodeValue);
		$this->setCreateTime($xml->getElementsByTagName('CreateTime')->item(0)->nodeValue);
		$this->setMsgType($xml->getElementsByTagName('MsgType')->item(0)->nodeValue);
		$this->setMessageData($xml);
	}

	/**
	 * @param \DOMDocument $xml
	 * @return mixed
	 */
	abstract public function setMessageData(\DOMDocument $xml);
}