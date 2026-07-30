<!DOCTYPE html>
<html>

<head>

<title>Groco</title>

<style>

.top{

background:green;
color:white;
padding:15px;

}


</style>

</head>


<body>


<div class="top">

Groco


<a href="/home" style="color:white;margin-left:20px;">Home</a>

<a href="/dashboard" style="color:white;margin-left:20px;">Dashboard</a>

<a href="/logout" style="color:white;margin-left:20px;">Logout</a>

</div>


<div style="padding:20px;">

@yield('content')

</div>


</body>

</html>