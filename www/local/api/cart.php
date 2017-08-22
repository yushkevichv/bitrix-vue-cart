<?
/**
 * Created by PhpStorm.
 * User: yushkevichv
 * Date: 21.08.17
 * Time: 22:36
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
define("STOP_STATISTICS", true);
define('NO_AGENT_CHECK', true);
//

use Bitrix\Main\Loader;
use Bitrix\Sale;


//use Bitrix\Sale\Internals\BasketTable as CSaleBasket;


Loader::includeModule("sale");

$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());

$data = json_decode(file_get_contents('php://input'), true);
$product = $data['product']; //
$productId = $data['product_id'];
$quantity = $data['quantity'];

/** int $productId ID товара */
/** int $quantity количество */
//var_dump($productId);

if ($item = $basket->getExistsItem('catalog', $product)) {
    $item->setField('QUANTITY', $quantity);
}
else {
    $item = $basket->createItem('catalog', $product);
    $item->setFields(array(
        'QUANTITY' => $quantity,
        'CURRENCY' => Bitrix\Currency\CurrencyManager::getBaseCurrency(),
        'LID' => Bitrix\Main\Context::getCurrent()->getSite(),
        'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
    ));
}
$basket->save();

$basketItems = $basket->getBasketItems();
foreach ($basket as $basketItem) {
    echo $basketItem->getField('NAME') . ' - ' . $basketItem->getQuantity() . ' - '. $basketItem->getProductId() .' <br />';
}
//var_dump($basket->getListOfFormatText());

//use Bitrix\Sale;
//
//

//
//if(isset($data)) {
//    $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
//
//    return $price = $basket->getPrice();
//}








