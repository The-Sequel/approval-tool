@extends('layouts.app-master')

@section('content')
<form action="{{route('admin.tasks.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="form-group">
        <label for="title">Titel</label>
        <input class="form-control" type="text" name="title" id="title">
    </div>

    <div class="form-group">
        <label for="description">Beschrijving</label>
        <textarea class="form-control" name="description" id="description"></textarea>
    </div>

    <div class="form-group">
        <label for="deadline">Deadline</label>
        <input class="form-control" type="date" name="deadline" id="deadline">
    </div>

    <div class="form-group">
        <label for="image">Afbeelding</label>
        <input class="form-control" type="file" name="image" id="image">
    </div>

    <div class="form-group">
        <label for="department_id">Afdeling</label>
        <select name="department_id" id="department_id">
            <option value="">Selecteer een afdeling</option>
            @foreach($departments as $department)
                <option value="{{$department->id}}">{{$department->title}}</option>
            @endforeach
        </select>
    </div>

    <input type="hidden" type="text" name="status" id="status" value="pending">
    <input type="hidden" type="text" name="user_id" id="user_id" value={{Auth::user()->id}}>
    <input type="hidden" type="text" name="project_id" id="project_id" value={{$project->id}}>
    <input type="hidden" type="text" name="customer_id" id="customer_id" value={{$project->customer->id}}>

    <div class="form-group">
        <button>Maak nieuwe taak</button>
    </div>
</form>
@endsection
