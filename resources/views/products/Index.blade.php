<!DOCTYPE html>
<html>
<head>
    <title>Grocery Shop - Home</title>

    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }

        .top-bar {
            margin-bottom: 20px;
        }

        .product {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            width: 300px;
        }

        img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
    </style>

</head>
<body>

<!-- Top Menu -->
<div class="top-bar">

    @auth
        Welcome, {{ auth()->user()->name }} |

        <a href="{{ url('/dashboard') }}">Dashboard</a> |

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>

    @else

        <a href="{{ route('login') }}">Login</a> |
        <a href="{{ route('register') }}">Register</a>

    @endauth

</div>


<h1>All Products</h1>


@foreach($products as $product)

    <div class="product">

        <h3>{{ $product->name }}</h3>

        {{-- Product Image --}}
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}">
        @else
            <img src="https://via.placeholder.com/200">
        @endif

        <p>Price: {{ $product->price }} TK</p>

        <p>Quantity: {{ $product->quantity }}</p>

    </div>

@endforeach


</body>
</html>