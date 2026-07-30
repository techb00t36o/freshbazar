<!DOCTYPE html>
<html>
<head>

<title>Shop</title>

<style>

body{font-family:Arial;margin:0;}

.navbar{
display:flex;
justify-content:space-between;
padding:15px 40px;
background:#eee;
}

.logo{color:green;font-size:26px;font-weight:bold;}

.menu a{
background:blue;
color:white;
padding:8px 15px;
margin:5px;
text-decoration:none;
}

.title{
text-align:center;
color:blue;
font-size:35px;
margin-top:40px;
}

.category-btn{
text-align:center;
margin:30px;
}

.category-btn button{
background:blue;
color:white;
padding:10px 20px;
border:none;
margin:10px;
}

.products{
display:flex;
justify-content:center;
gap:30px;
}

.card{
border:1px solid #ccc;
padding:20px;
width:200px;
text-align:center;
}

</style>

</head>

<body>

<div class="navbar">

<div class="logo">Groco.</div>

<div class="menu">
<a href="/home">Home</a>
<a href="/shop">Shop</a>
<a href="/contact">Contact</a>
</div>

</div>


<h2 class="title">PRODUCT CATEGORY</h2>

<div class="category-btn">

<button>Fish</button>
<button>Meat</button>
<button>Vegetable</button>
<button>Fruit</button>

</div>


<div class="products">

<div class="card"><h3>Banana</h3></div>
<div class="card"><h3>Tomato</h3></div>
<div class="card"><h3>Chicken</h3></div>
<div class="card"><h3>Fish</h3></div>

</div>

</body>
</html>