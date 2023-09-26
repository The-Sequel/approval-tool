<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    @vite(['resources/css/style.css', 'resources/js/customers.js'])
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

<style>
    *{
        margin: 0;
        padding: 0;
    }

    .container{
        display: flex;
        flex-direction: column;
    }

    .content{
        width: 100%;
    }
</style>