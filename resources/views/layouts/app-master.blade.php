<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('layouts.sidebar')
    <div class="container">
        @include('layouts.header')
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
        flex-direction: column;
    }

    .content{
        width: 100%;
    }

    /* Table */
    .table{
        width: 50%;
        height: 50%;
        margin-left: 1rem;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    .table tr {
        height: 10px;
    }

    .table th{
        padding: 1rem;
        text-align: left;
        border: 1px solid #e6e6e6;
    }

    .table td{
        font-weight: normal;
        cursor: pointer;
        padding: 1rem;
        text-align: left;
        border: 1px solid #e6e6e6;
    }
</style>