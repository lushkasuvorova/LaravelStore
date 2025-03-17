@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p><strong>Цена:</strong> {{ number_format($product->price / 100, 2) }} ₽</p>
    <p><strong>Категория:</strong> {{ $product->category->category ?? 'Без категории' }}</p>
    <p><strong>Описание:</strong> {{ $product->description }}</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Назад к списку</a>
</div>
@endsection
