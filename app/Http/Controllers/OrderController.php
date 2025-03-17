<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    // Просмотр списка заказов
    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        return view('orders.index', compact('orders'));
    }

    // Создание нового заказа
    public function create()
    {
        $products = $this->orderService->getProducts();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $result = $this->orderService->createOrder($request->all());

        // Если валидация не прошла
        if ($result instanceof \Illuminate\Support\MessageBag) {
            return redirect()->back()->withErrors($result)->withInput();
        }

        // Если заказ успешно создан
        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    public function show(Order $order)
    {
        //return view('orders.show', compact('order'));
        return view('orders.edit', compact('order'));
    }

    // Редактирование заказа
    public function edit(Order $order)
    {
        $products = $this->orderService->getProducts();
        return view('orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $result = $this->orderService->updateOrder($order, $request->all());

        // Если валидация не прошла
        if ($result instanceof \Illuminate\Support\MessageBag) {
            return redirect()->back()->withErrors($result)->withInput();
        }

        // Если заказ успешно обновлен
        return redirect()->route('orders.index')->with('success', 'Статус заказа изменен на "выполнен"');
    }

    // Удаление заказа
    public function destroy(Order $order)
    {
        $this->orderService->deleteOrder($order);
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}
