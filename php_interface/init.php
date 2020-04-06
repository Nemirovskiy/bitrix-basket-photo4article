<?
Bitrix\Main\Loader::registerAutoLoadClasses(null, $arClass);
$root = Bitrix\Main\Context::getCurrent()->getServer()->getDocumentRoot();
require $root."/local/php_interface/include/events.php";