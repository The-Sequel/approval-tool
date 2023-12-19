{{-- <style>

body{
    background-color: #ffffff;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
    max-width: 800px;
    margin: 0 auto;
    padding: 2%;
}

header{
    display: flex;
    justify-content: center;
    margin-bottom: 2%;
}

#wrapper{
    margin: 0 auto;
    background: #ffffff;
}

.content{
    padding: 2%;
}

</style> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div class="grid">
        <div id="logo">
            <img width="200" height="122" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" data-ll-status="loaded">
        </div>
    </div>
    {{-- <div id="wrapper" style=>
        <header>
            <div id="logo">
                <img width="200" height="122" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" data-ll-status="loaded">
            </div>
        </header>
        <div id="content">
            <h2>Nieuwe taak!</h2>
        </div>
    </div> --}}
</body>
</html>

{{-- @extends('layouts.mail')

@section('content') --}}
    {{-- <td align="center" style="padding: 0;">
        Hello!
    </td> --}}
    {{-- <h2>Nieuwe taak!</h2>
    <p>Er is een nieuwe <a href="{{route('customer.tasks.show', $task->id)}}">taak</a> aangemaakt!</p>
    @if($task->project_id != null)
        <p>Gekoppeld aan <a href="{{route('customer.projects.show', $task->project_id)}}">project</a></p>
    @endif

    <img src="{{asset('storage/'.$task->customer->logo)}}" alt="Avatar" style="width:200px; height:200px; border-radius: 50%; margin-top: 50px;"> --}}

{{-- @endsection --}}