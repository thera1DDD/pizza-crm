<?php

namespace App\Actions;

use App\Models\Order;

class AddItemsToOrderAction
{
    public function execute(Order $order, array $items): Order
    {
        $order->items = array_merge($order->items, $items);
        $order->save();
        return $order;
    }
}
