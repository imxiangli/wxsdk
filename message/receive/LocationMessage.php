<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 08:24
 */

namespace imxiangli\wxsdk\message\receive;


class LocationMessage extends Message
{
	public $location_X;
	public $location_Y;
	public $scale;
	public $label;
	public $msgId;

	public function setMessageData(\DOMDocument $xml)
	{
		$this->setLocationX($xml->getElementsByTagName('Location_X')->item(0)->nodeValue);
		$this->setLocationY($xml->getElementsByTagName('Location_Y')->item(0)->nodeValue);
		$this->setScale($xml->getElementsByTagName('Scale')->item(0)->nodeValue);
		$this->setLabel($xml->getElementsByTagName('Label')->item(0)->nodeValue);
		$this->setMsgId($xml->getElementsByTagName('MsgId')->item(0)->nodeValue);
	}

	/**
	 * @return mixed
	 */
	public function getLocationX()
	{
		return $this->location_X;
	}

	/**
	 * @param mixed $location_X
	 */
	public function setLocationX($location_X)
	{
		$this->location_X = $location_X;
	}

	/**
	 * @return mixed
	 */
	public function getLocationY()
	{
		return $this->location_Y;
	}

	/**
	 * @param mixed $location_Y
	 */
	public function setLocationY($location_Y)
	{
		$this->location_Y = $location_Y;
	}

	/**
	 * @return mixed
	 */
	public function getScale()
	{
		return $this->scale;
	}

	/**
	 * @param mixed $scale
	 */
	public function setScale($scale)
	{
		$this->scale = $scale;
	}

	/**
	 * @return mixed
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * @param mixed $label
	 */
	public function setLabel($label)
	{
		$this->label = $label;
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