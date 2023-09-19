<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('layouts.header')
    <div class="container">
        @include('layouts.sidebar')
        <div class="content">
            @yield('content')
        </div>
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
    }

    .content{
        width: 100%;
    }
</style>