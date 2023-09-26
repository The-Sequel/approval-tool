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
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description"></textarea>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input class="form-control" type="date" name="deadline" id="deadline">
        </div>

        <div class="form-group">
            <label for="department">Department</label>
            <select class="form-control" name="department" id="department">
                <option value="">Select department</option>
                @foreach($departments as $department)
                    <option value="{{$department->id}}">{{$department->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select class="form-control" name="customer_id" id="customer_id">
                <option value="">Select customer</option>
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" type="text" name="status" id="status" value="pending">
        <input type="hidden" type="text" name="created_by" id="created_by" value="{{Auth::user()->id}}">

        <div class="form-group">
            <button>Maak</button>
        </div>

        {{-- hidden fields --}}
        {{-- <input type="hidden" type="text" name="status" id="status" value="pending">

        @foreach($customers as $customer)
            @if($customer->id == $user->customer_id)
                <input type="hidden" type="text" name="customer_id" id="customer_id" value={{$customer->id}}>
                <input type="hidden" type="text" name="user_id" id="user_id" value={{$user->id}}>
                <input type="hidden" type="text" name="created_by" id="created_by" value={{$user->name}}>
            @endif
        @endforeach

        <div class="form-group">
            <input type="submit" value="Create" class="btn btn-primary">
        </div>
    </form> --}}
@endsection