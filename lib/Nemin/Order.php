<?php


namespace Nemin;


use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use Bitrix\Main\Context;
use \Bitrix\Main\Event;
use \Bitrix\Sale\Compatible\EventCompatibility;
use \Bitrix\Sale\PropertyValueBase;

class Order
{


	/**
	 * @param Event $event
	 */
	static public function orderSaved(Event $event){
		$propsCode = "UTM_SOURCE";
		$order = $event->getParameter("ENTITY");
		$request = Context::getCurrent()->getRequest();
		$source = $request->getCookie('utm_source');
		if($order->isNew() && $source){
			$propCollection = $order->getPropertyCollection();
			foreach($propCollection as $propertyValue){
				$arFieldValues = $propertyValue->getFieldValues();
				if($arFieldValues["CODE"] === $propsCode){
					$propertyValue->setValue($source);
					break;
				}
			}
		}
	}

	static public function utmToCookie(){
		$request = Context::getCurrent()->getRequest();
		$getSource = $request->get('utm_source');
		$cookieSource = $request->getCookie('utm_source');
		if($getSource && !$cookieSource){
			$time = 86400*30;
			$domen = Context::getCurrent()->getServer()->get('HTTP_HOST');
			$cookie = new \Bitrix\Main\Web\Cookie("utm_source", $getSource, time()+$time);
			$cookie->setDomain($domen);
			$cookie->setPath("/");
			Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
		}
	}
}