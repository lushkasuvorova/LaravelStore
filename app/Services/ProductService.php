<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Category;

class ProductService
{
    public function getAllProducts()
    {
        return Product::with('category')->get();
    }

    public function getCategories()
    {
        return Category::all();
    }

    public function createProduct($data)
    {
        $data['price'] = round($data['price'] * 100);
        $product = new Product($data);
        $product->validate();
        $product->create($data);
        return $product;
    }

    public function updateProduct($product, $data)
    {
        $data['price'] = round($data['price'] * 100);
        $product->fill($data);
        $product->validate();
        $product->update();
        return $product;
    }

    public function deleteProduct($product)
    {
        $product->delete();
    }
}
