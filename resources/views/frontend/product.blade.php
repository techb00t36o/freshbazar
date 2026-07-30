@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-5">
        <img src="{{ $product->image ? (Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image)) : asset('image/shop.jpg') }}" class="img-fluid">
    </div>
    <div class="col-md-7">
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->description }}</p>
        <h4>৳ {{ $product->price }}</h4>

        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button class="btn btn-success">Add to Cart</button>
        </form>
    </div>
</div>
@endsection
