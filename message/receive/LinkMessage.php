<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 08:26
 */

namespace imxiangli\wxsdk\message\receive;


class LinkMessage extends Message
{
	public $title;
	public $description;
	public $url;
	public $msgId;

	public function setMessageData(\DOMDocument $xml)
	{
		$this->setTitle($xml->getElementsByTagName('Title')->item(0)->nodeValue);
		$this->setDescription($xml->getElementsByTagName('Description')->item(0)->nodeValue);
		$this->setUrl($xml->getElementsByTagName('Url')->item(0)->nodeValue);
		$this->setMsgId($xml->getElementsByTagName('MsgId')->item(0)->nodeValue);
	}

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 * @return mixed
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param mixed $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
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