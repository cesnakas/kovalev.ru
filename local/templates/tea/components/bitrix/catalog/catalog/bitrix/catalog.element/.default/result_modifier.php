<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hlbl = 2; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


if (!empty($arResult["PROPERTIES"]["SOSTAV"]["VALUE"])) {
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();

    $rsData = $entity_data_class::getList(array(
        "select" => array("*"),
        "order" => array("ID" => "ASC"),
        "filter" => array("UF_XML_ID" => $arResult["PROPERTIES"]["SOSTAV"]["VALUE"])  // Задаем параметры фильтра выборки
    ));
    unset($arResult["PROPERTIES"]["SOSTAV"]["VALUE"]);

    while ($arData = $rsData->Fetch()) {
        $arResult["PROPERTIES"]["SOSTAV"]["VALUE"][] = $arData;

    }
}


if (!empty($arResult["PROPERTIES"]["SOSTAV_FULL"]["VALUE"])) {
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();

    $rsData = $entity_data_class::getList(array(
        "select" => array("*"),
        "order" => array("ID" => "ASC"),
        "filter" => array("UF_XML_ID" => $arResult["PROPERTIES"]["SOSTAV_FULL"]["VALUE"])  // Задаем параметры фильтра выборки
    ));
    unset($arResult["PROPERTIES"]["SOSTAV_FULL"]["VALUE"]);

    while ($arData = $rsData->Fetch()) {
        $arResult["PROPERTIES"]["SOSTAV_FULL"]["VALUE"][] = $arData;

    }
}

if (!empty($arResult["PROPERTIES"]["RECOMMENDED_WITH_IT"]["VALUE"])) {
    $res = CIBlockElement::GetByID($arResult["PROPERTIES"]["RECOMMENDED_WITH_IT"]["VALUE"]);
    $arResult["PROPERTIES"]["RECOMMENDED_WITH_IT"]["VALUE"] = $res->GetNext();
}


$entity = HL\HighloadBlockTable::compileEntity('3');
$entity_data_class = $entity->getDataClass();

$rsData = $entity_data_class::getList(array(
    "select" => array("*"),
    "order" => array("ID" => "DESC"),
    "filter" => array("UF_TOVAR" => $arResult["ID"]),
    "limit"=>"3"// Задаем параметры фильтра выборки
));


while ($arData = $rsData->Fetch()) {
    $arResult["PROPERTIES"]["OTZUVU"]["VALUE"][] = $arData;

}


