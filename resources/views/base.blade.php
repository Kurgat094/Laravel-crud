<!-- base.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @stack('styles')
</head>
<body>
<header>
        <nav>
           
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#about">About Me</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
                
                @auth 
                <li><a href="/logout">Logout</a></li>
                @else
                <li><a href="/login">Login</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main>
        

       

        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
