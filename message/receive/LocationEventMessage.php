<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 08:52
 */

namespace imxiangli\wxsdk\message\receive;


class LocationEventMessage extends EventMessage
{
	public $latitude;
	public $longitude;
	public $precision;

	public function setMessageData(\DOMDocument $xml)
	{
		parent::setMessageData($xml);
		$this->setLatitude($xml->getElementsByTagName('Latitude')->item(0)->nodeValue);
		$this->setLongitude($xml->getElementsByTagName('Longitude')->item(0)->nodeValue);
		$this->setPrecision($xml->getElementsByTagName('Precision')->item(0)->nodeValue);
		$this->setMsgEventType(self::TYPE_EVENT_LOCATION);
	}

	/**
	 * @return mixed
	 */
	public function getLatitude()
	{
		return $this->latitude;
	}

	/**
	 * @param mixed $latitude
	 */
	public function setLatitude($latitude)
	{
		$this->latitude = $latitude;
	}

	/**
	 * @return mixed
	 */
	public function getLongitude()
	{
		return $this->longitude;
	}

	/**
	 * @param mixed $longitude
	 */
	public function setLongitude($longitude)
	{
		$this->longitude = $longitude;
	}

	/**
	 * @return mixed
	 */
	public function getPrecision()
	{
		return $this->precision;
	}

	/**
	 * @param mixed $precision
	 */
	public function setPrecision($precision)
	{
		$this->precision = $precision;
	}
}