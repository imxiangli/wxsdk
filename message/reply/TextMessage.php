<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/22
 * Time: 10:29
 */

namespace imxiangli\wxsdk\message\reply;


class TextMessage extends Message
{
	public $content;

	public function __construct()
	{
		$this->msgType = self::TYPE_TEXT;
	}

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

	public function getXmlFormat()
	{
		return "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
	}

	public function getXmlFormatParams()
	{
		return [
			$this->toUserName,
			$this->fromUserName,
			$this->createTime,
			$this->msgType,
			$this->content
		];
	}
}