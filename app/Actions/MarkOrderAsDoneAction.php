<?php

namespace App\Actions;

use App\Models\Order;

class MarkOrderAsDoneAction
{
    public function execute(Order $order): Order
    {
        $order->done = true;
        $order->save();
        return $order;
    }
}
