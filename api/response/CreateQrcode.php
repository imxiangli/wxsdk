<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 15:57
 */

namespace imxiangli\wxsdk\api\response;


class CreateQrcode extends Response
{
	public $ticket;
	public $expire_seconds;
	public $url;

	public function init($data)
	{
		if(isset($data['ticket']))
		{
			$this->ticket = $data['ticket'];
		}
		if(isset($data['expire_seconds']))
		{
			$this->expire_seconds = $data['expire_seconds'];
		}
		if(isset($data['url']))
		{
			$this->url = $data['url'];
		}
	}

	public function getQrcodeUrl()
	{
		return 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($this->ticket);
	}
}