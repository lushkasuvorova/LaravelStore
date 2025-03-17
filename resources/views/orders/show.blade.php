@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $order->status }}</h1>
    <p><strong>Товар:</strong> {{ $order->product->name }}</p>
    <p><strong>Кол-во:</strong> {{ $order->number }} </p>
    <p><strong>Покупатель:</strong> {{ $order->customer_fio }} </p>
    <p><strong>Комментарий:</strong> {{ $order->customer_komment }} </p>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Назад к списку</a>
</div>
@endsection