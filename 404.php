<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>

    <main class="error-page">
        <div class="container">
            <div class="error-page__content">
                <h1>404</h1>
                <p>Данной страницы не существует</p>
                <a href="/" class="btn-brown">Вернуться на главную</a>
            </div>
        </div>
    </main>


<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>