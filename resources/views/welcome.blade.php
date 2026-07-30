<!DOCTYPE html>
<html>

<head>
    <title>Freshbazar</title>

    <style>
        body {
            text-align: center;
            font-family: Arial;
            margin-top: 200px;

            background: url("{{ asset('image/freshbazar-bg.jpg') }}") no-repeat center center;
            background-size: cover;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.6);
            z-index: -1;
        }

        h1 {
            font-size: 50px;
            color: blue;
        }

        button {
            background: blue;
            color: white;
            padding: 12px 25px;
            border: none;
            font-size: 18px;
            margin: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h1>Welcome To Our FreshBazar</h1>

    <a href="/login">
        <button>Login</button>
    </a>

    <a href="/register">
        <button>Registration</button>
    </a>

</body>

</html>