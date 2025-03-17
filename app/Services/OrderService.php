<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderService
{
    public function getAllOrders()
    {
        return Order::with('product')->get();
    }

    public function getProducts()
    {
        return Product::all();
    }

    public function createOrder($data)
    {
        $validator = Order::validate($data);

        if ($validator->fails()) {
            return $validator;
        }

        return Order::create($data);
    }

    public function updateOrder($order, $data)
    {
        $order->update(['status' => 'выполнен']);
        return $order;
    }

    public function deleteOrder($order)
    {
        if (!$order instanceof Order) {
            $order = Order::findOrFail($order);
        }
        $order->delete();
    }
}