@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-8">
        <form action="{{route('admin.tasks.finish', $task)}}" method="POST" enctype="multipart/form-data" id="finish-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="files">Bestanden</label>
                <input type="file" name="files[]" id="files" multiple>
            </div>
            <div class="form-group">
                <label for="description">Beschrijving</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>

            @include('sections.mail')

            <div class="form-group" id="form-group">
                <button onclick="event.preventDefault(); openMailPopup();">Voltooi taak</button>
                <button class="delete" onclick="event.preventDefault(); deleteTaskPopup();">Verwijder taak</button>
            </div>
        </form>
        <form id="delete-form-task" action="{{route('admin.tasks.destroy', $task)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
    @if(count($reasons) > 0)
        <div class="col-4">
            <div class="denied-card">
                <div class="denied-card-reason">
                    <h3 class="denied-card-reason-header">Reden(en) van afwijzing</h3>
                    @foreach($reasons as $reason)
                        <p>{{$reason->reason}}</p>
                    @endforeach
                    <div class="button-container">
                        <button onclick="">Toon meer</button>
                    </div>
                </div>
            </div>
            <div class="task-information-card">
                <div class="task-information-card-body">
                    <h2>{{$task->title}}</h2>
                    <p><span>Klant:</span> {{$task->customer->name}}</p>
                    <p>{!! nl2br($task->description) !!}</p>
                    <p><span>Deadline:</span> {{$task->deadline}}</p>
                    <p><span>Status:</span> afgekeurd</p>
                    @if($task->images)
                        @php
                            $imagesArray = json_decode($task->images, true);
                        @endphp

                        @if(is_array($imagesArray) && count($imagesArray) > 0)
                            <div class="image-gallery">
                                @foreach($imagesArray as $image)
                                    <a href="{{ asset('storage/' . $image) }}">
                                        <img src="{{ asset('storage/' . $image) }}" style="width: 50%; height: auto; margin-bottom: 10px;">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

    @else
        <div class="col-4">
            <div class="task-information-card">
                <div class="task-information-card-body">
                    <h2>{{$task->title}}</h2>
                    <p><span>Klant:</span> {{$task->customer->name}}</p>
                    <p>{!! nl2br($task->description) !!}</p>
                    <p><span>Deadline:</span> {{$task->deadline}}</p>
                    <p><span>Status:</span> goedgekeurd</p>
                    @if($task->images)
                        @php
                            $imagesArray = json_decode($task->images, true);
                        @endphp

                        @if(is_array($imagesArray) && count($imagesArray) > 0)
                            <div class="image-gallery">
                                @foreach($imagesArray as $image)
                                    <a href="{{ asset('storage/' . $image) }}">
                                        <img src="{{ asset('storage/' . $image) }}" style="width: 50%; height: auto; margin-bottom: 10px;">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    // function openMailPopup(){
    //     document.querySelector('.mail-popup .text-container').style.visibility = 'visible';
    // }

    function openMailPopup(){
        document.querySelector('.mail-popup .text-container').style.visibility = 'visible';
    }
</script>

@include('sections.delete.task')

@endsection