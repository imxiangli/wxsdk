<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/22
 * Time: 10:46
 */

namespace imxiangli\wxsdk\message\receive;


class TextMessage extends Message
{
	public $content;
	public $msgId;

	/**
	 * @return mixed
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * @param mixed $content
	 */
	public function setContent($content)
	{
		$this->content = $content;
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

	public function setMessageData(\DOMDocument $xml)
	{
		$this->setContent($xml->getElementsByTagName('Content')->item(0)->nodeValue);
		$this->setMsgId($xml->getElementsByTagName('MsgId')->item(0)->nodeValue);
	}
}