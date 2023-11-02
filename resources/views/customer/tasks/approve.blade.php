@extends('layouts.app-master')

@section('content')
<div class="grid" style="margin-left: 270px;">
    <div class="col-6">
        {{-- <h1>{{$task->title}}</h1> --}}
        <div class="task-information">
            @if($task->description_completed != null)
                <h3 style="margin-bottom: 20px;">Beschrijving</h3>
                <div class="task-information-description">
                    {{$task->description_completed}}
                </div>
            @endif
            <div class="task-information-completed_by">
                @php
                    $user = \App\Models\User::where('id', $task->completed_by)->first();
                @endphp
                <p><h3>Voltooid door:</h3> {{$user->name}}</p>
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
    @php
        $images = json_decode($task->image_completed, true);
    @endphp
    @if(count($images) > 0)
        <div class="col-6">
            @if($task->image_completed != null)
                <div class="task-information">
                    @if($task->image_completed != null)
                        <div class="task-information-images">
                            @php
                                $imagePaths = json_decode($task->image_completed, true);
                            @endphp
                            @foreach($imagePaths as $image)
                                <a href="{{ asset('storage/' . $image) }}">
                                    <img src="{{ asset('storage/' . $image) }}" style="width: 50%; width: 200px; margin-bottom: 10px;">
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        </div>
    @endif
</div>

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