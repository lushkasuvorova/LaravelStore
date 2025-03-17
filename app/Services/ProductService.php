<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

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
        $validator = Product::validate($data);

        if ($validator->fails()) {
            return $validator;
        }

        return Product::create($data);
    }

    public function updateProduct($product, $data)
    {
        $validator = Product::validate($data);

        if ($validator->fails()) {
            return $validator;
        }

        $product->update($data);
        return $product;
    }

    public function deleteProduct($product)
    {
        $product->delete();
    }
}
