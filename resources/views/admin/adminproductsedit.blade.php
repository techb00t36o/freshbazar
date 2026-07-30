@extends('admin.layout')

@section('content')
<h2>Edit Product</h2>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>
    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>
    <div class="mb-3">
        <label>Image</label><br>
        <img src="{{ $product->image ? (Str::startsWith($product->image, 'http') ? $product->image : asset('storage/'.$product->image)) : asset('image/shop.jpg') }}" width="80" class="mb-2"><br>
        <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
