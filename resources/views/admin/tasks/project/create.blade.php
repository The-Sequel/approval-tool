@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form action="{{route('admin.tasks.store')}}" method="POST" enctype="multipart/form-data" id="add-user-form">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="title">Titel *</label>
                <input class="form-control" type="text" name="title" id="title">
            </div>

            <div class="form-group">
                <label for="description">Beschrijving *</label>
                <textarea class="form-control" name="description" id="description"></textarea>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input class="form-control" type="date" name="deadline" id="deadline">
            </div>

            <div class="form-group">
                <label for="images">Afbeeldingen</label>
                <input class="form-control" type="file" name="images[]" id="images" multiple>
            </div>

            <div class="form-group">
                <label for="department_id">Afdeling</label>
                <select class="form-control" name="department_id" id="department_id">
                    <option value="">Selecteer afdeling</option>
                    @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->title}}</option>
                    @endforeach
                </select>
            </div>

            @include('sections.add-user')

            {{-- <div style="height: 60px; margin-top: 30px;">
                <p style="margin-bottom: 8px;">Voeg gebruikers toe aan taak</p>
                @foreach($users as $user)
                    <input type="checkbox" name="user_ids[]" id="user_id_{{$user->id}}" value="{{$user->id}}">
                    {{$user->name}} <br>
                @endforeach
            </div> --}}

            <div style="margin-bottom: 20px; margin-top: 20px;">
                <input type="checkbox" name="send_mail" id="send_mail">
                <label for="send_mail">Stuur mail</label>
            </div>

            <input type="hidden" type="text" name="status" id="status" value="pending">
            <input type="hidden" type="text" name="created_by" id="created_by" value="{{Auth::user()->id}}">
            <input type="hidden" type="text" name="project_id" id="project_id" value="{{$project->id}}">
            <input type="hidden" type="text" name="customer_id" id="customer_id" value="{{$project->customer->id}}">

            <div class="form-group">
                <button onclick="event.preventDefault(); openAddUsersToTaskPopup();">Maak nieuwe taak</button>
            </div>
        </form>
    </div>
</div>

@include('sections.error')

<script>
    function openAddUsersToTaskPopup(){
        document.querySelector('.add-user-popup .text-container').style.visibility = 'visible';
    }
</script>

@endsection