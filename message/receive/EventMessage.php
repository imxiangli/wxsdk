<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 08:48
 */

namespace imxiangli\wxsdk\message\receive;


abstract class EventMessage extends Message
{
	const TYPE_EVENT_SUBSCRIBE = 'event_subscribe';
	const TYPE_EVENT_QRSCENE = 'event_qrscene';
	const TYPE_EVENT_LOCATION = 'event_Location';
	const TYPE_EVENT_CLICK = 'event_click';
	const TYPE_EVENT_VIEW = 'event_view';

	public $event;
	public $msgEventType;

	public function setMessageData(\DOMDocument $xml)
	{
		$this->setEvent($xml->getElementsByTagName('Event')->item(0)->nodeValue);
	}

	/**
	 * @return mixed
	 */
	public function getEvent()
	{
		return $this->event;
	}

	/**
	 * @param mixed $event
	 */
	public function setEvent($event)
	{
		$this->event = $event;
	}

	/**
	 * @return mixed
	 */
	public function getMsgEventType()
	{
		return $this->msgEventType;
	}

	/**
	 * @param mixed $msgEventType
	 */
	public function setMsgEventType($msgEventType)
	{
		$this->msgEventType = $msgEventType;
	}
}