<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/22
 * Time: 09:43
 */

namespace imxiangli\wxsdk\message\reply;


abstract class Message
{
	const TYPE_TEXT  = 'text';
	const TYPE_IMAGE = 'image';
	const TYPE_VOICE = 'voice';
	const TYPE_VIDEO = 'video';
	const TYPE_MUSIC = 'music';
	const TYPE_NEWS  = 'news';

	public $toUserName;
	public $fromUserName;
	public $createTime;
	public $msgType;

	/**
	 * @return string
	 */
	abstract public function getXmlFormat();

	/**
	 * @return array
	 */
	abstract public function getXmlFormatParams();

	/**
	 * @return string
	 */
	public function toXml()
	{
		$format = $this->getXmlFormat();
		$xml = vsprintf($format, $this->getXmlFormatParams());
		return $xml;
	}

	public function setToUserName($toUserName)
	{
		$this->toUserName = $toUserName;
	}

	public function getToUserName()
	{
		return $this->toUserName;
	}

	public function setFromUserName($fromUserName)
	{
		$this->fromUserName = $fromUserName;
	}

	public function getFromUserName()
	{
		return $this->fromUserName;
	}

	public function setCreateTime($createTime)
	{
		$this->createTime = $createTime;
	}

	public function getCreateTime()
	{
		return $this->createTime;
	}

	public function setMsgType($msgType)
	{
		$this->msgType = $msgType;
	}

	public function getMsgType()
	{
		return $this->msgType;
	}
}