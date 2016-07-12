<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/22
 * Time: 09:48
 */

namespace imxiangli\wxsdk;


use imxiangli\wxsdk\message\reply\TextMessage;

class NormalMessageReceiver extends MessageReceiver
{
	/**
	 * @return message\reply\Message
	 */
	public function getReply()
	{
		// TODO: 以下是测试代码
		$message = '你发送的信息为 %s 类型';
		if(null != $this->message)
		{
			$message = sprintf($message, get_class($this->message));
			$reply = new TextMessage();
			$reply->setCreateTime(time());
			$reply->setFromUserName($this->message->toUserName);
			$reply->setToUserName($this->message->fromUserName);
			$reply->setContent($message);
			return $reply;
		}
	}
}