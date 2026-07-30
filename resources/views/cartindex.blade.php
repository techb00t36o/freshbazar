@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<h2>Your Cart</h2>

@if(session('cart') && count(session('cart')) > 0)
<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php $grandTotal = 0; @endphp
        @foreach(session('cart') as $id => $item)
            @php $total = $item['price'] * $item['quantity']; $grandTotal += $total; @endphp
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>৳ {{ $item['price'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>৳ {{ $total }}</td>
                <td>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>Grand Total: ৳ {{ $grandTotal }}</h4>

<a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceed to Checkout</a>
@else
<p>Your cart is empty.</p>
@endif
@endsection
