@extends('layouts.app')

@section('content')
    <h1>Добавить новый заказ</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="status">Статус</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ old('status') ?? 'новый' }}" required>
        </div>

        <div class="form-group">
            <label for="product_id">Товар</label>
            <select name="product_id" id="product_id" class="form-control" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">Количество</label>
            <input type="number" name="number" id="number" class="form-control" value="{{ old('number') ?? 1 }}" required>
        </div>

        <div class="form-group">
            <label for="customer_fio">ФИО покупателя</label>
            <input type="text" name="customer_fio" id="customer_fio" class="form-control" value="{{ old('customer_fio') }}" required>
        </div>

        <div class="form-group">
            <label for="customer_komment">Комментарий покупателя</label>
            <input type="text" name="customer_komment" id="customer_komment" class="form-control" value="{{ old('customer_komment') }}">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
