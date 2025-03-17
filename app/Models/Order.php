<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'number', 'customer_fio', 'customer_komment', 'product_id'];

    public static function validate($data)
    {
        return Validator::make($data, [
            'status' => 'required|in:новый,выполнен',
            'number' => 'required|string|max:255|unique:orders',
            'customer_fio' => 'required|string|max:255',
            'customer_komment' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
        ]);
    }
}
