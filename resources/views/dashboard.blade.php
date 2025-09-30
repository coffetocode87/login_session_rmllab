<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h2>Welcome, {{ auth()->user()->name }}</h2>
    <p>Role: {{ auth()->user()->role }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <a href="/admin">Halaman Admin</a> | <a href="/user">Halaman User</a>
</body>

</html>
