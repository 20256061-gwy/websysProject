<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
</head>
<body>
    <h1>Welcome, Doctor {{ auth()->user()->name }}!</h1>
    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>