<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddItemsRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use http\Env\Response;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->createOrder($request->items);

        return response()->json([
            'order_id' => $order->order_id,
            'items' => $order->items,
            'done' => $order->done,
        ]);
    }

    public function addItems(AddItemsRequest $request, $order_id)
    {
        $order = Order::where('order_id', $order_id)->where('done', false)->firstOrFail();
        $order = $this->orderService->addItems($order, $request->all());

        return response()->json([
            'order_id' => $order->id,
            'items' => $order->items,
            'done' => $order->done,
        ]);
    }

    public function show($order_id)
    {
        $order = Order::findOrFail($order_id);

        return response()->json([
            'order_id' => $order->id,
            'items' => $order->items,
            'done' => $order->done,
        ]);
    }

    public function markAsDone(Request $request, $order_id)
    {
        $this->authorizeRequest($request);
        $order = $this->orderService->markAsDone($order_id);
        return response()->json([
            'order_id' => $order->id,
            'done' => $order->done,
        ]);
    }

    public function index(Request $request)
    {
        $this->authorizeRequest($request);

        $orders = $this->orderService->getOrders($request);

        return response()->json($orders);
    }


    protected function authorizeRequest($request)
    {
        abort_unless($request->header('X-Auth-Key') === config('app.auth_key'), 403);
    }
}
