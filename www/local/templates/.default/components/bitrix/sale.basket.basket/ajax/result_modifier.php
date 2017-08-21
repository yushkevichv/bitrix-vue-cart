<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
use Bitrix\Main;

$defaultParams = array(
	'TEMPLATE_THEME' => 'blue'
);
$arParams = array_merge($defaultParams, $arParams);
unset($defaultParams);

$arParams['TEMPLATE_THEME'] = (string)($arParams['TEMPLATE_THEME']);
if ('' != $arParams['TEMPLATE_THEME'])
{
	$arParams['TEMPLATE_THEME'] = preg_replace('/[^a-zA-Z0-9_\-\(\)\!]/', '', $arParams['TEMPLATE_THEME']);
	if ('site' == $arParams['TEMPLATE_THEME'])
	{
		$templateId = (string)Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', SITE_ID);
		$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? 'eshop_adapt' : $templateId;
		$arParams['TEMPLATE_THEME'] = (string)Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', SITE_ID);
	}
	if ('' != $arParams['TEMPLATE_THEME'])
	{
		if (!is_file($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
			$arParams['TEMPLATE_THEME'] = '';
	}
}
if ('' == $arParams['TEMPLATE_THEME'])
	$arParams['TEMPLATE_THEME'] = 'blue';

$products = [];

foreach ($arResult['ITEMS']['AnDelCanBuy'] as $key=>$product) {
    $arResult['products'][$key]['id'] = $product['ID'];
    $arResult['products'][$key]['name'] = $product['NAME'];
    $arResult['products'][$key]['product_id'] = $product['PRODUCT_ID'];
    $arResult['products'][$key]['price'] = $product['PRICE'];
    $arResult['products'][$key]['price_formatted'] = $product['PRICE_FORMATED'];
    $arResult['products'][$key]['url'] = $product['DETAIL_PAGE_URL'];
    $arResult['products'][$key]['count'] = $product['MEASURE'];
    $arResult['products'][$key]['measure_text'] = $product['MEASURE_TEXT'];
    $arResult['products'][$key]['picture'] = $product['DETAIL_PICTURE_SRC'];

}
