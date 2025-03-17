<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderService
{
    // Получение списка всех заказов с их товарами
    public function getAllOrders()
    {
        return Order::with('product')->get();
    }

    // Получение всех продуктов для выпадающего списка
    public function getProducts()
    {
        return Product::all();
    }

    // Создание нового заказа
    public function createOrder($data)
    {
        $validator = Order::validate($data); // Валидация через метод модели

        if ($validator->fails()) {
            return $validator; // Возвращаем ошибки валидации
        }

        // Если валидация прошла успешно, создаем заказ
        return Order::create($data);
    }

    // Обновление заказа
    public function updateOrder($order, $data)
    {
        //$validator = Order::validate($data); // Валидация через метод модели

        // if ($validator->fails()) {
        //     return $validator; // Возвращаем ошибки валидации
        // }

        // Если валидация прошла успешно, обновляем заказ
        //$order->update($data);
        $order->update(['status' => 'выполнен']);
        return $order;
    }

    // Удаление заказа
    public function deleteOrder($order)
    {
        if (!$order instanceof Order) {
            $order = Order::findOrFail($order);
        }
        $order->delete();
    }
}