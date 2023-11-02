@extends('layouts.app-master')

@section('content')
<div class="grid" style="margin-left: 270px;">
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

                @if($task->project !== null && $task->project->id === null)
                    <div class="form-group">
                        <label for="department_id">Afdeling</label>
                        <select class="form-control" name="department_id" id="department_id">
                            <option value="">Selecteer afdeling</option>
                            @foreach($departments as $department)
                                @if($department->id == $task->department_id)
                                    <option value="{{$department->id}}" selected>{{$department->title}}</option>
                                @else
                                    <option value="{{$department->id}}">{{$department->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endif

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

                @if($task->project !== null && $task->project->id === null)
                    <div class="form-group">
                        <label for="department_id">Afdeling</label>
                        <select class="form-control" name="department_id" id="department_id">
                            <option value="">Selecteer afdeling</option>
                            @foreach($departments as $department)
                                @if($department->id == $task->department_id)
                                    <option value="{{$department->id}}" selected>{{$department->title}}</option>
                                @else
                                    <option value="{{$department->id}}">{{$department->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endif

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
                    <img src="{{asset('storage/' . $task->image)}}" alt="" width=450>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    function deleteTask(){
        if(confirm('Weet je zeker dat je deze taak wilt verwijderen?')){
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection