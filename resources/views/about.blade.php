<!DOCTYPE html>
<html>
<head>
<title>About - Groco</title>

<style>

body{
margin:0;
font-family:Arial, Helvetica, sans-serif;
background:#f2f2f2;
}

/* NAVBAR */

.nav{
display:flex;
justify-content:space-between;
align-items:center;
padding:15px 60px;
background:white;
box-shadow:0 2px 5px rgba(0,0,0,0.1);
}

.logo{
font-size:28px;
font-weight:bold;
color:#27ae60;
}

.menu a{
margin-left:20px;
text-decoration:none;
color:#333;
font-size:16px;
text-transform:lowercase;
}

.menu a:hover{
color:#27ae60;
}


/* TITLE */

.section-title{
text-align:center;
margin-top:60px;
font-size:30px;
font-weight:bold;
}

.section-title span{
color:#27ae60;
}


/* REVIEW GRID */

.review-container{
display:grid;
grid-template-columns:repeat(auto-fit, minmax(280px,1fr));
gap:30px;
padding:60px 80px;
}

.review-card{
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
text-align:center;
}

.review-card img{
width:90px;
height:90px;
border-radius:50%;
margin-bottom:15px;
}

.review-card p{
font-size:14px;
color:#555;
line-height:1.6;
}

.stars{
color:#f39c12;
margin:15px 0;
font-size:18px;
}

.review-card h3{
margin-top:10px;
font-size:16px;
}


/* FOOTER */

.footer{
background:#222;
color:white;
padding:40px;
text-align:center;
margin-top:60px;
}

</style>

</head>
<body>

<!-- NAVBAR -->

<div class="nav">
<div class="logo">Groco.</div>

<div class="menu">
<a href="/home">home</a>
<a href="/home#shop">shop</a>
<a href="#">orders</a>
<a href="/about">about</a>
<a href="/home#contact">contact</a>
<a href="/logout">logout</a>
</div>
</div>


<!-- TITLE -->

<div class="section-title">
CLIENTS <span>REVIEWS</span>
</div>


<!-- REVIEW SECTION -->

<div class="review-container">

<div class="review-card">
<img src="https://randomuser.me/api/portraits/men/32.jpg">
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates sit earum neque non cupiditate amet deserunt aperiam quas.</p>
<div class="stars">★★★★★</div>
<h3>john deo</h3>
</div>

<div class="review-card">
<img src="https://randomuser.me/api/portraits/women/44.jpg">
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates sit earum neque non cupiditate amet deserunt aperiam quas.</p>
<div class="stars">★★★★★</div>
<h3>john deo</h3>
</div>

<div class="review-card">
<img src="https://randomuser.me/api/portraits/men/65.jpg">
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates sit earum neque non cupiditate amet deserunt aperiam quas.</p>
<div class="stars">★★★★★</div>
<h3>john deo</h3>
</div>

<div class="review-card">
<img src="https://randomuser.me/api/portraits/women/12.jpg">
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates sit earum neque non cupiditate amet deserunt aperiam quas.</p>
<div class="stars">★★★★★</div>
<h3>john deo</h3>
</div>

<div class="review-card">
<img src="https://randomuser.me/api/portraits/men/22.jpg">
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates sit earum neque non cupiditate amet deserunt aperiam quas.</p>
<div class="stars">★★★★★</div>
<h3>john deo</h3>
</div>

<div class="review-card">
<img src="https://randomuser.me/api/portraits/women/30.jpg">
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates sit earum neque non cupiditate amet deserunt aperiam quas.</p>
<div class="stars">★★★★★</div>
<h3>john deo</h3>
</div>

</div>


<!-- FOOTER -->

<div class="footer">
© 2022 Groco. All rights reserved.
</div>

</body>
</html>