<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'number', 'customer_fio', 'customer_komment', 'product_id'];

    public function validate()
    {
        return Validator::make($this->attributesToArray(), [
            'number' => 'required|string|max:255|unique:orders,number',
            'customer_fio' => 'required|string|max:255',
            'customer_komment' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'status' => 'required|in:новый,выполнен',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
