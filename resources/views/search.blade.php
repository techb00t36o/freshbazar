<!DOCTYPE html>
<html>

<head>

<title>Search Result</title>

<style>

.title{

text-align:center;
color:blue;
font-size:35px;
margin-top:30px;

}

.product{

border:1px solid #ccc;
width:250px;
margin:20px auto;
padding:20px;
text-align:center;

}

button{

background:green;
color:white;
padding:10px;
border:none;

}

</style>

</head>

<body>

<h2 class="title">Search Result</h2>

@foreach($result as $item)

<div class="product">

<h3>{{ $item }}</h3>

<button>Add To Cart</button>

</div>

@endforeach

</body>

</html>