<!DOCTYPE html>
<html>

<head>

<title>Login</title>

<style>

body{

font-family:Arial;
margin:0;
background:#f5f5f5;

}


.box{

width:400px;

margin:150px auto;

background:white;

padding:40px;

text-align:center;

border-radius:10px;

box-shadow:0px 0px 10px gray;

}



h1{

font-size:40px;

}



input{

width:90%;

padding:12px;

margin:10px;

font-size:18px;

}



button{

background:red;

color:white;

padding:12px 25px;

border:none;

font-size:20px;

border-radius:5px;

cursor:pointer;

}



a{

display:block;

margin-top:15px;

font-size:18px;

}

</style>

</head>


<body>



<div class="box">

<h1>

Login Now

</h1>


<form method="GET" action="/dashboard">

<input type="email" placeholder="Email">

<br>

<input type="password" placeholder="Password">

<br>

<button>

Login

</button>

</form>


<a href="/register">

Register Now

</a>

</div>



</body>

</html>