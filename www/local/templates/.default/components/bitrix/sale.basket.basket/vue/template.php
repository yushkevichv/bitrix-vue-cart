<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixBasketComponent $component */

// TODO need refactor to work with float value

$allSum = (int) $arResult['allSum'];
$allBaseSum = (int) ($arResult['allSum'] + $arResult['DISCOUNT_PRICE_ALL']);

?>

<cart :arr-products="<?=htmlentities(json_encode($arResult['ITEMS']['AnDelCanBuy']))?>"
      :total-basket-price="<?=$allSum;?>"
      :total-basket-base-price="<?=$allBaseSum;?>"
>
</cart>
