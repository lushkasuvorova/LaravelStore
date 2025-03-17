<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    // Получение списка всех товаров с их категориями
    public function getAllProducts()
    {
        return Product::with('category')->get();
    }

    // Получение всех категорий для выпадающего списка
    public function getCategories()
    {
        return Category::all();
    }

    // Создание нового товара
    public function createProduct($data)
    {
        $validator = Product::validate($data); // Валидация через метод модели

        if ($validator->fails()) {
            return $validator; // Возвращаем ошибки валидации
        }

        // Если валидация прошла успешно, создаем продукт
        return Product::create($data);
    }

    // Обновление товара
    public function updateProduct($product, $data)
    {
        $validator = Product::validate($data); // Валидация через метод модели

        if ($validator->fails()) {
            return $validator; // Возвращаем ошибки валидации
        }

        // Если валидация прошла успешно, обновляем продукт
        $product->update($data);
        return $product;
    }

    // Удаление товара
    public function deleteProduct($product)
    {
        $product->delete();
    }
}
