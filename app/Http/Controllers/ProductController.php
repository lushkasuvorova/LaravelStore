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

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->productService->getCategories();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $result = $this->productService->createProduct($request->all());
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($result)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ошибка при добавлении товара.');
        }
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = $this->productService->getCategories();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $result = $this->productService->updateProduct($product, $request->all());
            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($result)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ошибка при редактировании товара.');
        }
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}

