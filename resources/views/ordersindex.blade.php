@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<h2>My Orders</h2>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>৳ {{ $order->total }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
