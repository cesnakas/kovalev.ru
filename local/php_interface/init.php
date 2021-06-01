<?php

use Bitrix\Main;
use Bitrix\Sale;


Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderSaved',
    'setElementsWeight'
);


function setElementsWeight(Main\Event $event)
{
    /** @var Order $order */
    $order = $event->getParameter("ENTITY");

    $isNew = $event->getParameter("IS_NEW");

    if ($isNew) {

        $basket = $order->getBasket();
        $basketItems = $basket->getBasketItems(); // массив объектов Sale\BasketItem
        foreach ($basketItems as $item) {

            $weight = $item->getWeight();     // Вес
            $basketPropertyCollection = $item->getPropertyCollection();

            $basketPropertyCollection->setProperty(array(
                array(
                    'NAME' => 'Вес',
                    'CODE' => 'CUSTOM_WEIGHT',
                    'VALUE' => $weight . " гр",
                    'SORT' => 100,
                   
                ),
            ));
            $basketPropertyCollection->save();

        }


    }

}