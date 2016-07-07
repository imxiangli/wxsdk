<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 08:29
 */

namespace imxiangli\wxsdk\message\receive;


class SubscribeEventMessage extends EventMessage
{
	public function setMessageData(\DOMDocument $xml)
	{
		parent::setMessageData($xml);
		$this->setMsgEventType(self::TYPE_EVENT_SUBSCRIBE);
	}
}