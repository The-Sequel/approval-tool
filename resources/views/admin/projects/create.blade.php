@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
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

            <input type="hidden" type="text" name="status" id="status" value="pending">
            <input type="hidden" type="text" name="created_by" id="created_by" value="{{Auth::user()->id}}">

            <div class="form-group">
                <button>Maak nieuw project</button>
            </div>
        </form>
    </div>
</div>

@include('sections.error')

@endsection
