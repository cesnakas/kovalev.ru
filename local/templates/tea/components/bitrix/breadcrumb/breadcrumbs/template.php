<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult))
    return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();

$strReturn .= '<div class="breadcrumb-wrap" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<div class="container">
				<ul class="breadcrumb">
';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    $arrow = ($index > 0 ? '<i class="fa fa-angle-right"></i>' : '');

    if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {
        $strReturn .= '
			<li  id="bx_breadcrumb_' . $index . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				' . $arrow . '
				<a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '" itemprop="item">
				' . $title . '
				</a>
				<meta itemprop="position" content="' . ($index + 1) . '" />
			</li>';
    } else {
        $strReturn .= '
			<li class="bx-breadcrumb-item">
				' . $arrow . '
				<span>' . $title . '</span>
			</li>';
    }
}

$strReturn .= '	</ul>
			</div>
		</div>';

return $strReturn;
?>



