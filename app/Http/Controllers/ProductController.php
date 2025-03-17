<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Просмотр списка товаров
    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    // Создание нового товара
    public function create()
    {
        $categories = $this->productService->getCategories();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $result = $this->productService->createProduct($request->all());

        // Если валидация не прошла
        if ($result instanceof \Illuminate\Support\MessageBag) {
            return redirect()->back()->withErrors($result)->withInput();
        }

        // Если товар успешно создан
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Редактирование товара
    public function edit(Product $product)
    {
        $categories = $this->productService->getCategories();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $result = $this->productService->updateProduct($product, $request->all());

        // Если валидация не прошла
        if ($result instanceof \Illuminate\Support\MessageBag) {
            return redirect()->back()->withErrors($result)->withInput();
        }

        // Если товар успешно обновлен
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // Удаление товара
    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}

