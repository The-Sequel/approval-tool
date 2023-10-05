@extends('layouts.app-master')

@section('content')
<div class="grid">
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
                <input type="checkbox" name="send_mail" id="send_mail">
                <label for="send_mail">Stuur mail</label>
            </div>
            <div>
                @foreach($users as $user)
                    @if($task->customer == $user->customer)
                    <input type="checkbox" id="user_{{$user->id}}" name="assigned_users[]" value="{{$user->id}}">
                    <label for="user_{{$user->id}}">{{$user->name}}</label><br>
                    @endif
                @endforeach
            </div>
            <div class="form-group">
                <button>Voltooi taak</button>
                <button class="delete" onclick="event.preventDefault(); deleteTask();">Verwijder taak</button>
            </div>
        </form>
        <form id="delete-form" action="{{route('admin.tasks.destroy', $task)}}" method="POST">
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
        </div>
    @else
        {{-- <div class="col-4">
            <div class="task-information-card">
                <div class="task-information-card-header">
                    <h3 class="task-information-card-header-title">{{$task->title}}</h3>
                    <p class="task-information-card-header-subtitle">{{$task->customer->name}}</p>
                </div>
                <div class="task-information-card-body">
                    <p class="task-information-card-body-description">{{$task->description}}</p>
                    <p class="task-information-card-body-deadline">Deadline: {{$task->deadline}}</p>
                    <p class="task-information-card-body-department">Afdeling: {{$task->department->title}}</p>
                    <p class="task-information-card-body-status">Status: {{$task->status}}</p>
                </div>
            </div>
        </div> --}}
    @endif
</div>

<style>
    .denied-card {
        width: 100%;
        height: 256px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-top: 25px;
        display: flex;
    }

    .denied-card-reason {
        width: 100%;
        height: 100%;
        padding: 20px;
    }

    .denied-card-reason-header {
        margin-bottom: 10px;
    }

    /* .task-information-card{
        width: 100%;
        height: 256px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-top: 25px;
    } */
</style>

<script>
    function deleteTask() {
        var result = confirm("Weet je zeker dat je deze taak wilt verwijderen?");

        if(result){
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection