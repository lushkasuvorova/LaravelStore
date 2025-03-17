@extends('layouts.app')

@section('content')
    <h1>Список заказов</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">Добавить заказ</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Дата создания</th>
                <th>ФИО покупателя</th>
                <th>Статус</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->id }}</a></td>
                    <td>{{ $order->created_at }} </td>
                    <td>{{ $order->customer_fio }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ number_format($order->product->price*$order->number / 100, 2) }} ₽</td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Del</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection