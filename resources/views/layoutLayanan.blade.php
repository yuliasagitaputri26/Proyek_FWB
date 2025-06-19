<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Layanan</title>
</head>
<body>
    <nav>
        <a href="{{ route('services.index') }}">Layanan</a> |
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
    <hr>

    @yield('content')
</body>
</html>
