<?php
/**
 * Created by PhpStorm.
 * User: lixiang
 * Date: 16/2/20
 * Time: 11:55
 */

namespace imxiangli\wxsdk\api;


use imxiangli\wxsdk\api\response\Response;
use Psr\Http\Message\ResponseInterface;
use yii\helpers\Json;

abstract class Api
{
	abstract public function setParams($params);

	abstract public function request();

	protected function processResponse(Response $response, ResponseInterface $apiResponse)
	{
		if(200 == $apiResponse->getStatusCode())
		{
			$content = $apiResponse->getBody()->getContents();
			try{
				$data = Json::decode($content);
				$response->setResponseData($data);
			}catch(\Exception $e){

			}
			$response->rawResponse = $content;
		}
		else
		{
			throw new \Exception('api request error');
		}
	}
}