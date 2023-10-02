@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-6">
        <h1>{{$task->title}}</h1>
        <div class="task-information">
            <div class="task-information-images">
                @php
                    $imagePaths = json_decode($task->image_completed, true);
                @endphp
                @foreach($imagePaths as $image)
                    <img src="{{asset('storage/'.$image)}}" alt="">
                @endforeach
            </div>
            <div class="task-information-description">
                {{$task->description_completed}}
            </div>
            <div class="task-information-completed_by">
                <p>Voltooid door: {{$task->completed_by}}</p>
            </div>
        </div>
        
        <form action="{{route('customer.tasks.finish', $task)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <button name="accept" value="accept" id="accept">Goedkeuren</button>
                <button style="background-color: red;" id="decline" onclick="event.preventDefault();">Afkeuren</button>
            </div>
            <div class="form-group">
                <textarea style="display: none;" name="message" id="message" cols="30" rows="10" placeholder="Bericht"></textarea>
            </div>
            <div class="form-group">
                <button name="accept" value="decline" style="display: none;" id="send">Verstuur</button>
            </div>
        </form>
    </div>
</div>

<style>
    .task-information{
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    }

    .task-information-images{
        display: flex;
        flex-direction: row;
        gap: 40px;
        align-items: center;
        /* keep the images in the task-information div */
        overflow: auto;
    }

    .task-information-images img{
        width: 250px;
        height: 250px;
        object-fit: cover;
        border-radius: 5px;
    }

    .task-information-description{
        margin-top: 20px;
    }
</style>

<script>
    // when the decline button is clicked, show the textarea
    document.getElementById('decline').addEventListener('click', function() {
        if(document.getElementById('message').style.display == 'none'){
            document.getElementById('message').style.display = 'block';
            document.getElementById('send').style.display = 'block';
        } else {
            document.getElementById('message').style.display = 'none';
            document.getElementById('send').style.display = 'none';
        }
    });

    document.getElementById('accept').addEventListener('click', function() {
        document.getElementById('send').style.display = 'none';
    })
</script>
@endsection