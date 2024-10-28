<?php

namespace App\Services;

use App\Actions\AddItemsToOrderAction;
use App\Actions\CreateOrderAction;
use App\Actions\MarkOrderAsDoneAction;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderService
{
    protected $createOrderAction;
    protected $addItemsToOrderAction;
    protected $markOrderAsDoneAction;

    public function __construct(
        CreateOrderAction $createOrderAction,
        AddItemsToOrderAction $addItemsToOrderAction,
        MarkOrderAsDoneAction $markOrderAsDoneAction
    ) {
        $this->createOrderAction = $createOrderAction;
        $this->addItemsToOrderAction = $addItemsToOrderAction;
        $this->markOrderAsDoneAction = $markOrderAsDoneAction;
    }

    public function createOrder(array $items): Order
    {
        return $this->createOrderAction->execute($items);
    }

    public function getOrders(Request $request)
    {
        return Order::when($request->has('done'), function ($query) use ($request) {
            $query->where('done', $request->boolean('done'));
        })->get();
    }

    public function addItems(Order $order, array $items): Order
    {
        return $this->addItemsToOrderAction->execute($order, $items);
    }

    public function markAsDone(int $order_id): Order
    {
        $order = Order::where('order_id', $order_id)->where('done', false)->firstOrFail();
        return $this->markOrderAsDoneAction->execute($order);
    }
}
