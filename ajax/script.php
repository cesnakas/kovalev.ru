<?php
set_time_limit(3600);
//$_SERVER["DOCUMENT_ROOT"]="";
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');


$arSelect = array("ID", "DETAIL_PICTURE");
$arFilter = array("IBLOCK_ID" => IntVal('1'), "!DETAIL_PICTURE" => false, "ID");
$res = CIBlockElement::GetList(array("ID" => "DESC"), $arFilter, false, array("nTopCount" => 5), $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();

    $filepath = $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($arFields["DETAIL_PICTURE"]);

    if (!file_exists($filepath)) {

        $el = new CIBlockElement;
        $arLoadProductArray = array(
            "DETAIL_PICTURE" => false,
        );
        $res = $el->Update($arFields["ID"], $arLoadProductArray);

    }
}
