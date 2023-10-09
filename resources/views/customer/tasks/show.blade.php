@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <div class="task-card-information">
            <div class="task-card-information-body">
                <h2>{{$task->title}}</h2>
                <p>{{$task->customer->name}}</p>
                <p>{{$task->description}}</p>
                <p><span>Deadline:</span> {{$task->deadline}}</p>
                <p><span>Status:</span> {{$task->status}}</p>
                @if($task->image)
                    <a href="{{asset('storage/' . $task->image)}}"><img src="{{asset('storage/' . $task->image)}}" style="width: 50%; height: 100%;"></a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection