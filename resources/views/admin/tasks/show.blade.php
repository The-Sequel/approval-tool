@extends('layouts.app-master')

@section('content')
<div class="grid" style="margin-left: 270px;">
    <div class="col-8">
        <form action="{{route('admin.tasks.finish', $task)}}" method="POST" enctype="multipart/form-data">
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
            <div style="margin-bottom: 20px;">
                <p style="margin-bottom: 10px">Verstuur mail</p>
                <input type="checkbox" name="send_mail" id="send_mail">
                <label for="send_mail">Stuur mail</label>
                {{-- <svg style="margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg> --}}
            </div>
            <div>
                <p style="margin-bottom: 10px;">Gebruikers voor mail</p>
                @foreach($users as $user)
                    @if($task->customer == $user->customer)
                        <input type="checkbox" id="user_{{$user->id}}" name="assigned_users[]" value="{{$user->id}}">
                        <label for="user_{{$user->id}}">{{$user->name}}</label><br>
                    @endif
                @endforeach
            </div>
            <div class="form-group">
                <button>Voltooi taak</button>
                <button class="delete" onclick="event.preventDefault(); deleteTaskPopup();">Verwijder taak</button>
            </div>
        </form>
        <form id="delete-form-task" action="{{route('admin.tasks.destroy', $task)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
    @if($task->status == 'denied')
        <div class="col-4">
            <div class="denied-card">
                <div class="denied-card-reason">
                    <h3 class="denied-card-reason-header">Reden van afwijzing</h3>
                    <p>{{$task->reason}}</p>
                </div>
            </div>
            <div class="task-information-card">
                <div class="task-information-card-body">
                    <h2>{{$task->title}}</h2>
                    <p><span>Klant:</span> {{$task->customer->name}}</p>
                    <p>{!! nl2br($task->description) !!}</p>
                    <p><span>Deadline:</span> {{$task->deadline}}</p>
                    <p><span>Status:</span> {{$task->status}}</p>
                    @if($task->images)
                        @php
                            $imagesArray = json_decode($task->images, true);
                        @endphp

                        @if(is_array($imagesArray) && count($imagesArray) > 0)
                            <div class="image-gallery">
                                @foreach($imagesArray as $image)
                                    <a href="{{ asset('storage/' . $image) }}">
                                        <img src="{{ asset('storage/' . $image) }}" style="width: 70%; height: auto; margin-bottom: 10px;">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    @endif

                    {{-- @if($task->images)
                        @foreach($task->images as $image)
                            <a href="{{asset('storage/' . $image->image)}}"><img src="{{asset('storage/' . $image->image)}}" style="width: 100%; height: 100%;"></a>
                        @endforeach
                        <a href="{{asset('storage/' . $task->image)}}"><img src="{{asset('storage/' . $task->image)}}" style="width: 100%; height: 100%;"></a>
                    @endif --}}
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
                    <p><span>Status:</span> {{$task->status}}</p>
                    @if($task->images)
                        @php
                            $imagesArray = json_decode($task->images, true);
                        @endphp

                        @if(is_array($imagesArray) && count($imagesArray) > 0)
                            <div class="image-gallery">
                                @foreach($imagesArray as $image)
                                    <a href="{{ asset('storage/' . $image) }}">
                                        <img src="{{ asset('storage/' . $image) }}" style="width: 70%; height: auto; margin-bottom: 10px;">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    @endif

                    {{-- @if($task->images)
                        @foreach($task->images as $image)
                            <a href="{{asset('storage/' . $image->image)}}"><img src="{{asset('storage/' . $image->image)}}" style="width: 100%; height: 100%;"></a>
                        @endforeach
                        <a href="{{asset('storage/' . $task->image)}}"><img src="{{asset('storage/' . $task->image)}}" style="width: 100%; height: 100%;"></a>
                    @endif --}}
                </div>
            </div>
        </div>
    @endif
</div>

@include('sections.delete.task')

@endsection