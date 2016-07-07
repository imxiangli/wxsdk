<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/23
 * Time: 16:29
 */

namespace imxiangli\wxsdk\api\response;


class GetMaterial extends Response
{
	// 如果是图文素材
	public $news_item;

	// 如果是视频素材
	public $title;
	public $description;
	public $down_url;

	// 其他素材直接为素材文件内容使用 rawResponse

	public function init($data)
	{
		if(isset($data['news_item']))
		{
			$this->news_item = $data['news_item'];
		}
		if(isset($data['title']))
		{
			$this->title = $data['title'];
		}
		if(isset($data['description']))
		{
			$this->description = $data['description'];
		}
		if(isset($data['down_url']))
		{
			$this->down_url = $data['down_url'];
		}
	}
}