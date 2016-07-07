<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 15:56
 */

namespace imxiangli\wxsdk\api\response;


abstract class Response
{
	public $apiError = false;
	public $apiErrorMsg;
	public $apiErrorCode;
	public $rawResponse = null;

	public function __construct($data = null)
	{
		if(null != $data)
		{
			$this->setResponseData($data);
		}
	}

	public function setResponseData($data)
	{
		if(isset($data['errcode']))
		{
			$this->apiErrorCode = $data['errcode'];
			$this->apiErrorMsg = $data['errmsg'];
		}
		if(isset($data['errcode']) && $data['errcode'] != 0)
		{
			$this->apiError = true;
		}
		else
		{
			$this->init($data);
		}
	}

	/**
	 * @return boolean
	 */
	public function isApiError()
	{
		return $this->apiError;
	}

	/**
	 * @param boolean $apiError
	 */
	public function setApiError($apiError)
	{
		$this->apiError = $apiError;
	}

	/**
	 * @return mixed
	 */
	public function getApiErrorMsg()
	{
		return $this->apiErrorMsg;
	}

	/**
	 * @param mixed $apiErrorMsg
	 */
	public function setApiErrorMsg($apiErrorMsg)
	{
		$this->apiErrorMsg = $apiErrorMsg;
	}

	/**
	 * @return mixed
	 */
	public function getApiErrorCode()
	{
		return $this->apiErrorCode;
	}

	/**
	 * @param mixed $apiErrorCode
	 */
	public function setApiErrorCode($apiErrorCode)
	{
		$this->apiErrorCode = $apiErrorCode;
	}
	
	abstract public function init($data);
}