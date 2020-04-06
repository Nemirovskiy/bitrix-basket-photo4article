<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;

if($arCurrentValues["SHOW_PRODUCTS"] == "Y")
{
	$arTemplateParameters = array(
		"SHOW_ARTICLE_IMAGE" => array(
			"NAME" => GetMessage('SBBL_SHOW_ARTICLE_IMAGE'),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"REFRESH" => "Y",
			"PARENT" => "LIST",
		)
	);
	if($arCurrentValues["SHOW_ARTICLE_IMAGE"] == "Y"){
		Bitrix\Main\Loader::includeModule('iblock');
		Bitrix\Main\Loader::includeModule('catalog');
		$arList = array(
			"select"=>array("ID","NAME"),
			"filter"=>array(">CATALOG.PRODUCT_IBLOCK_ID"=>0),
			"runtime"=> array(
				"CATALOG" => array(
					"data_type" => "\Bitrix\Catalog\CatalogIblockTable",
					"reference" => array(
						"this.IBLOCK_ID"=>"ref.IBLOCK_ID"
					)
				)
			)
		);
		$arProperty = array();
		$rsData = \Bitrix\Iblock\PropertyTable::getList($arList);
		while($arData = $rsData->fetch()){
			$arProperty[$arData["ID"]] = $arData["NAME"];
		}
		$arTemplateParameters["PROPERTY_ARTICLE"] = array(
			"NAME" => Loc::getMessage("SBBL_PARAMS_PROPERTY_ARTICLE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty,
			"PARENT" => "LIST",
		);
		$arTemplateParameters["TEMPLATE_URL"] = array(
			"NAME" => Loc::getMessage("SBBL_PARAMS_TEMPLATE_URL"),
			"TYPE" => "STRING",
			"DEFAULT" => "/upload/photo/#ARTICLE#.jpg",
			"PARENT" => "LIST",
		);
		$arTemplateParameters["ARTICLE_TTL"] = array(
			"NAME" => Loc::getMessage("SBBL_PARAMS_ARTICLE_TTL"),
			"TYPE" => "STRING",
			"DEFAULT" => "360000",
			"PARENT" => "LIST",
		);
	}
}
?>