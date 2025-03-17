@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $order->status }}</h1>
    <p><strong>Товар:</strong> {{ $order->product->name }}</p>
    <p><strong>Кол-во:</strong> {{ $order->number }} </p>
    <p><strong>Покупатель:</strong> {{ $order->customer_fio }} </p>
    <p><strong>Комментарий:</strong> {{ $order->customer_komment }} </p>
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="status" value="выполнен">

        <button type="submit" class="btn btn-primary">Выполнен</button>
    </form>
</div>
@endsection