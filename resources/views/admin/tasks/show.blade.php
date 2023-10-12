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
                <p style="margin-bottom: 10px">Verstuur mail:</p>
                <input type="checkbox" name="send_mail" id="send_mail">
                <label for="send_mail">Stuur mail</label>
            </div>
            <div>
                <p style="margin-bottom: 10px;">Gebruikers voor mail:</p>
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
        <div class="col-4">
            <div class="task-information-card">
                <div class="task-information-card-body">
                    <h2>{{$task->title}}</h2>
                    <p><span>Klant:</span> {{$task->customer->name}}</p>
                    <p>{{$task->description}}</p>
                    <p><span>Deadline:</span> {{$task->deadline}}</p>
                    <p><span>Status:</span> {{$task->status}}</p>
                    @if($task->image)
                        <a href="{{asset('storage/' . $task->image)}}"><img src="{{asset('storage/' . $task->image)}}" style="width: 100%; height: 100%;"></a>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    function deleteTask() {
        var result = confirm("Weet je zeker dat je deze taak wilt verwijderen?");

        if(result){
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection