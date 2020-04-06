<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 */
foreach($arResult["CATEGORIES"] as &$category){
	foreach($category as &$item){
		$item["PRODUCT_ID"];
		$arList = array(
			"filter"=>[
				"IBLOCK_PROPERTY_ID"=>$arParams["PROPERTY_ARTICLE"],
				"IBLOCK_ELEMENT_ID"=>$item["PRODUCT_ID"]
			],
			"select"=>["VALUE"],
			"cache"=>array("TTL"=>intval($arParams["ARTICLE_TTL"]))
		);
		$rsData = \Bitrix\Iblock\ElementPropertyTable::getList($arList);
		if(($arData = $rsData->fetch()) && strpos($arParams["TEMPLATE_URL"],"#ARTICLE#") >=0 ){
			$path = str_replace("#ARTICLE#",$arData["VALUE"], $arParams["TEMPLATE_URL"]);
			$file = new \Bitrix\Main\IO\File(\Bitrix\Main\Application::getDocumentRoot().$path);
			if($file->isExists()){
				$item["ARTICLE_IMAGE_SRC"] = $path;
			}
		}
	}
}
unset($category,$item);