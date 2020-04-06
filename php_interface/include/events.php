<?
$manager = Bitrix\Main\EventManager::getInstance();
$manager->addEventHandler(
	"main",
	"OnPageStart",
	array("\\Nemin\\Order","utmToCookie")
);
$manager->addEventHandler(
	"sale",
	"OnSaleOrderBeforeSaved",
	array("\\Nemin\\Order","orderSaved")
);
/*OnSaleOrderSaved*/