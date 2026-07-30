<!DOCTYPE html>
<html>
<head>

<title>Contact</title>

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

.contact-box{
width:400px;
margin:80px auto;
border:1px solid #ccc;
padding:30px;
text-align:center;
}

input,textarea{
width:100%;
padding:10px;
margin:10px 0;
}

button{
background:blue;
color:white;
padding:10px 20px;
border:none;
}

</style>

<script>

function sendmsg(){
alert("Message Successfully");
}

</script>

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


<div class="contact-box">

<h2>Contact Us</h2>

<input type="text" placeholder="Name">

<input type="email" placeholder="Email">

<input type="text" placeholder="Phone Number">

<textarea placeholder="Message"></textarea>

<button onclick="sendmsg()">Send Message</button>

</div>

</body>
</html>