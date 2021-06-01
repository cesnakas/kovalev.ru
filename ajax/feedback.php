<?php
if ($_POST['HIDDEN'] != strtotime('today midnight')) {
    die();
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('iblock');


$el = new CIBlockElement;

$TEXT = $_POST["EMAIL"] . " - " . $_POST["NAME"];

$arLoadProductArray = Array(
    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
    "IBLOCK_ID" => 4,
    "NAME" => $TEXT,
    "DETAIL_TEXT" => $_POST["TEXT"],

);

if ($PRODUCT_ID = $el->Add($arLoadProductArray))
    echo "New ID: " . $PRODUCT_ID;
else
    echo "Error: " . $el->LAST_ERROR;