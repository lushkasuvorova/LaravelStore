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

    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = $this->orderService->getProducts();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        try {
            $result = $this->orderService->createOrder($request->all());
            return redirect()->route('orders.index')->with('success', 'Order created successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($result)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ошибка при сохранении заказа.');
        }
    }

    public function show(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function edit(Order $order)
    {
        $products = $this->orderService->getProducts();
        return view('orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        try {
            $result = $this->orderService->updateOrder($order, $request->all());
            return redirect()->route('orders.index')->with('success', 'Статус заказа изменен на "выполнен"');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($result)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ошибка при сохранении заказа.');
        }
    }

    public function destroy(Order $order)
    {
        $this->orderService->deleteOrder($order);
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}
