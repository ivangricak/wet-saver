<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>vdoijvdsivhux</h1>
    @auth
        <p>Привіт, {{ auth()->user()->nick }}</p>
    @endauth

    @guest
        <p>Ви не залогінені</p>
    @endguest
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
</body>
</html>