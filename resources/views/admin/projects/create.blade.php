@extends('layouts.app-master')

@section('content')
    @if (session('error'))
        <div class="col-12">
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
        </div>
    @endif
    <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data">
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
            <label for="department">Afdeling *</label>
            <select class="form-control" name="department" id="department">
                <option value="">Select department</option>
                @foreach($departments as $department)
                    <option value="{{$department->id}}">{{$department->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="customer_id">Klant *</label>
            <select class="form-control" name="customer_id" id="customer_id">
                <option value="">Select customer</option>
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <input type="checkbox" name="send_mail" id="send_mail">
            <label for="send_mail">Stuur mail</label>
        </div>

        {{-- <div style="display: none;">
            <p style="margin-bottom: 8px;">Voeg gebruikers toe aan taak</p>
            @foreach($users as $user)
                @if($user->customer_id == )
                <input type="checkbox" name="user_ids[]" id="user_id_{{$user->id}}" value="{{$user->id}}">
                {{$user->name}} <br>
            @endforeach
        </div> --}}

        <input type="hidden" type="text" name="status" id="status" value="pending">
        <input type="hidden" type="text" name="created_by" id="created_by" value="{{Auth::user()->id}}">

        <div class="form-group">
            <button>Maak nieuw project</button>
        </div>
@endsection