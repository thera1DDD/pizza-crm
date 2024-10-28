<?php

namespace App\Actions;

use App\Models\Order;

class CreateOrderAction
{
    public function execute(array $items): Order
    {
        return Order::create(['items' => $items, 'done' => false]);
    }
}
