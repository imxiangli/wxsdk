<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 08:52
 */

namespace imxiangli\wxsdk\message\receive;


class ViewEventMessage extends EventMessage
{
	public $eventKey;

	public function setMessageData(\DOMDocument $xml)
	{
		parent::setMessageData($xml);
		$this->setEventKey($xml->getElementsByTagName('EventKey')->item(0)->nodeValue);
		$this->setMsgEventType(self::TYPE_EVENT_VIEW);
	}

	/**
	 * @return mixed
	 */
	public function getEventKey()
	{
		return $this->eventKey;
	}

	/**
	 * @param mixed $eventKey
	 */
	public function setEventKey($eventKey)
	{
		$this->eventKey = $eventKey;
	}
}