<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

if (!empty($_POST["SEARCH_SUBSTR"])) {
    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL");
    $arFilter = array("IBLOCK_ID" => IntVal(1), "ACTIVE" => "Y", "NAME" => $_POST["SEARCH_SUBSTR"] . "%");
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nTopCount" => 5), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arResult["ITEMS"][] = $ob->GetFields();

    }
}
?>

    <ul style="padding: 15px">
        <? foreach ($arResult["ITEMS"] as $ITEM) { ?>
            <li style="list-style: none;margin-bottom:10px "><a href="<?= $ITEM['DETAIL_PAGE_URL'] ?>"><span
                            class="nav-heading__name"><?= $ITEM["NAME"] ?></span></a></li>
        <?
        } ?>

        <?if(empty($arResult["ITEMS"])){?>
            <li style="list-style: none;margin-bottom:10px "><a ><span
                        class="nav-heading__name">Ничего не найдено</span></a></li>
        <?}?>
    </ul>

<?php

