<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approval Tool</title>
    {{-- @if(Auth::user()->status == 'inactive')
        {{ redirect()->route('login') }}
    @endif --}}

    @vite(['resources/css/style.css', 'resources/js/customers.js', 'resources/js/users.js'])
</head>
<body>
    @include('layouts.sidebar')
    <main class="container">
        @include('layouts.header')
        <div class="content">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>
</body>
</html>