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

Loader::includeModule("sale");

$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());

// если запрос на удаление
if(isset($_REQUEST['action']) && (($_REQUEST['action']) == 'delete') ) {
    if(isset($_REQUEST['id'])) {
        $basket->getItemById($_REQUEST['id'])->delete();
        $basket->save();
    }
}
// иначе считаем запрос на изменение стоимости
else {
    $data = json_decode(file_get_contents('php://input'), true);
    $product = $data['product']; //
    $productId = $data['product_id'];
    $quantity = $data['quantity'];

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
}


$return = [
    'totalBasketPrice' => $basket->getPrice(), // сумма с учетом скидок
    'totalBasketBasePrice' => $basket->getBasePrice(), // сумма без скидок
];

echo json_encode($return);
die();


