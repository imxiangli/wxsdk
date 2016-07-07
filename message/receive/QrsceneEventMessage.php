<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 08:47
 */

namespace imxiangli\wxsdk\message\receive;


class QrsceneEventMessage extends EventMessage
{
	public $eventKey;
	public $ticket;

	public function setMessageData(\DOMDocument $xml)
	{
		parent::setMessageData($xml);
		$this->setEventKey($xml->getElementsByTagName('EventKey')->item(0)->nodeValue);
		$this->setTicket($xml->getElementsByTagName('Ticket')->item(0)->nodeValue);
		$this->setMsgEventType(self::TYPE_EVENT_QRSCENE);
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

	/**
	 * @return mixed
	 */
	public function getTicket()
	{
		return $this->ticket;
	}

	/**
	 * @param mixed $ticket
	 */
	public function setTicket($ticket)
	{
		$this->ticket = $ticket;
	}
}