<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') - Clinic System</title>
</head>
<body>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('services.index') }}">Services</a>
        <form method="POST" action="/logout" style="display:inline">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>

    <div>
        @yield('content')
    </div>
</body>
</html>