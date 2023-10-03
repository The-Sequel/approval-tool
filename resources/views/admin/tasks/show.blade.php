@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
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
            </div>
        </form>
    </div>
</div>
@endsection