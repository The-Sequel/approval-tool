<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approval Tool</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/style.css', 'resources/js/customers.js', 'resources/js/notifications.js', 'resources/js/filters.js', 'resources/js/mobile-menu.js'])
</head>
<body>
    @include('layouts.sidebar')
    <main class="page-container">
        @include('layouts.header')
        <div class="content">
            @yield('content')
        </div>
        @include('layouts.mobile-sidebar')
        @include('layouts.footer')
    </div>
</body>
</html>
