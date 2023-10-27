@extends('layouts.app-master')

@section('content')
<div class="grid" style="margin-left: 270px;">
    <div class="col-12">
        <form action="{{route('admin.projects.update', $project)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$project->title}}">
            </div>
            <div class="form-group">
                <label for="description">Beschrijving</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$project->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" name="deadline" id="deadline" class="form-control" value="{{$project->deadline}}">
            </div>
            <div class="form-group">
                <label for="department_id">Afdeling</label>
                <select name="department_id" id="department_id" class="form-control">
                    @foreach($departments as $department)
                        <option value="{{$department->id}}" @if($project->department_id == $department->id) selected @endif>{{$department->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="customer_id">Klant</label>
                <select name="customer_id" id="customer_id" class="form-control">
                    @foreach($customers as $customer)
                        <option value="{{$customer->id}}" @if($project->customer_id == $customer->id) selected @endif>{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button>Opslaan</button>
                <button class="delete" onclick="event.preventDefault(); deleteProject();">Verwijder project</button>
            </div>
        </form>
        <form id="delete-form" action="{{route('admin.projects.destroy', $project)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
    function deleteProject() {
        if(confirm('Weet je zeker dat je dit project wilt verwijderen?')){
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection