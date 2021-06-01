<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");

$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", Array(
    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
),
    false
);
?>    <div class="container">
        <div class="contacts-page">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-5 col-sm-12 col-12">
                    <h1 class="title-page title-page--no_bg">Контакты</h1>
                    <div class="contacts-f__list">
                        <div class="contacts-f__item">
                            <div class="contacts-f__label contacts-f__label--phone contacts-f__label--black">
                                <div class="contacts-f__caption">Телефон</div>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_phone.php"
                                    )
                                ); ?>
                            </div>
                        </div>
                        <div class="contacts-f__item">
                            <div class="contacts-f__label contacts-f__label--social">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_mi_sotial.php"
                                    )
                                ); ?>
                            </div>
                        </div>
                        <div class="contacts-f__item">
                            <div class="contacts-f__label contacts-f__label--adress">
                                <div class="contacts-f__caption">Наша почта</div>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_mail.php"
                                    )
                                ); ?>
                            </div>
                        </div>
                        <div class="contacts-f__item">
                            <div class="contacts-f__label contacts-f__label--work">
                                <div class="contacts-f__caption">Время работы</div>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_worktime.php"
                                    )
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-7 col-sm-12 col-12">
                    <div class="feedback-box">
                        <form id="feedbackForm">
                            <div class="feedback-box__title">Есть вопросы? Напишите нам</div>
                            <div class="feedback-box__form">
                                <input required class="feedback-box__control" placeholder="Имя" type="text" name="NAME"/>
                                <input class="feedback-box__control" placeholder="Mail" type="email" required name="EMAIL"/>
                                <input class="feedback-box__control" placeholder="Ваш вопрос" type="text" required
                                       name="TEXT"/>
                            </div>
                            <div class="check-item">
                                <input class="check-item__input" disabled type="checkbox" name="" id="check1" checked/>
                                <label for="check1" class="check-item__label">Согласен с <a href="/privacy-policy/" target="_blank">условиями обработки
                                        персональных данных, пользовательского соглашения и публичной оферты</a></label>
                            </div>
                            <input type="submit" class="feedback-box__submit" value="Отправить вопрос"></input>
                            <input type="hidden" name="HIDDEN" value="<?=strtotime('today midnight')?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        document.getElementsByTagName('main')[0].className += " main--contacts"
    </script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>