<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'MySCAT: Sugar Craving Assessment Tool') }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicons/favicons.png') }}">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- Custom CSS (We move all style here) --}}
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/food-diary.css') }}">
    @yield('styles')



    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body style="background-color:#ffffff;">

    {{-- Navbar (exclude on login & register pages) --}}
    @unless (request()->routeIs('login') || request()->routeIs('register'))
        @include('partials.navbar')
    @endunless

    {{-- Page Content --}}
    <main class="main" id="top">
        @yield('content')
    </main>

    {{-- Footer (optional: include only if not login/register) --}}
    @unless (request()->routeIs('login') || request()->routeIs('register'))
        @include('partials.footer')
    @endunless

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">


</body>
</html>
