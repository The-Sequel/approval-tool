@extends('layouts.mail')

@section('content')
    <h2>Taak goedgekeurd!</h2>
    <p>Er is een <a href="{{route('admin.tasks.show', $task->id)}}">taak</a> <span style="color: green;">goedgekeurd!</span></p>
    @if($task->project_id != null)
        <p>Gekoppeld aan <a href="{{route('admin.projects.show', $task->project_id)}}">project</a></p>
    @endif

    <img src="{{asset('storage/'.$task->customer->logo)}}" alt="Avatar" style="width:200px; height:200px; border-radius: 50%; margin-top: 50px;">
@endsection