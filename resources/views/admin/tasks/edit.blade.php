@extends('layouts.app-master')

@section('content')
<div class="grid">
    @if($task->image != null)
        <div class="col-8">
            <form action="{{route('admin.tasks.update', $task)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$task->title}}">
                </div>
                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$task->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" name="deadline" id="deadline" class="form-control" value="{{$task->deadline}}">
                </div>
                <div class="form-group">
                    <label for="image">Afbeelding</label>
                    <input class="form-control" type="file" name="image" id="image">
                </div>
                <div>
                    <p style="margin-bottom: 8px;">Voeg gebruikers toe aan taak</p>
                    @foreach($users as $user)
                        @if(in_array($user->id, $assignedUsers))
                            <input type="checkbox" name="user_ids[]" id="user_id_{{$user->id}}" value="{{$user->id}}" checked>
                            {{$user->name}} <br>
                        @else
                            <input type="checkbox" name="user_ids[]" id="user_id_{{$user->id}}" value="{{$user->id}}">
                            {{$user->name}} <br>
                        @endif
                    @endforeach
                </div>
                
                <div class="form-group">
                    <button>Opslaan</button>
                    <button class="delete" onclick="event.preventDefault(); deleteTask();">Verwijder taak</button>
                </div>
            </form>
            <form id="delete-form" action="{{route('admin.tasks.destroy', $task)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
    @else
        <div class="col-12">
            <form action="{{route('admin.tasks.update', $task)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$task->title}}">
                </div>
                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$task->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" name="deadline" id="deadline" class="form-control" value="{{$task->deadline}}">
                </div>
                <div class="form-group">
                    <label for="image">Afbeelding</label>
                    <input class="form-control" type="file" name="image" id="image">
                </div>
                <div>
                    <p style="margin-bottom: 8px;">Voeg gebruikers toe aan taak</p>
                    @foreach($users as $user)
                        @if(in_array($user->id, $assignedUsers))
                            <input type="checkbox" name="user_ids[]" id="user_id_{{$user->id}}" value="{{$user->id}}" checked>
                            {{$user->name}} <br>
                        @else
                            <input type="checkbox" name="user_ids[]" id="user_id_{{$user->id}}" value="{{$user->id}}">
                            {{$user->name}} <br>
                        @endif
                    @endforeach
                </div>
                
                <div class="form-group">
                    <button>Opslaan</button>
                    <button class="delete" onclick="event.preventDefault(); deleteTask();">Verwijder taak</button>
                </div>
            </form>
            <form id="delete-form" action="{{route('admin.tasks.destroy', $task)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
    @endif
    @if($task->image != null)
        <div class="col-4">
            <div class="task-images-card">
                <div class="task-images-card-header">
                    <h3>Afbeeldingen</h3>
                </div>
                <div class="task-images-card-images">
                    <img src="{{asset('storage/' . $task->image)}}" alt="" width=50>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .task-images-card{
        margin-top: 25px;
        height: 100%;
        width: 100%;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        /* border-radius: 5%; */
    }

    .task-images-card-header{
        padding: 20px;
    }

    .task-images-card-images{
        padding: 20px;
    }
</style>

<script>
    function deleteTask(){
        if(confirm('Weet je zeker dat je deze taak wilt verwijderen?')){
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection