@extends('layouts.app-master')

@section('content')
    {{-- the first form is for users and the second form is for admins --}}
    {{-- The admin form may contain some more options --}}
    @if(session('alert'))
        <div class="alert alert-danger">
            {{session('alert')}}
        </div>
    @endif
    @if($user->role_id != 1)
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
                <label for="prio_level">Prio level</label>
                <select name="prio_level" id="prio_level">
                    <option value="3">Low</option>
                    <option value="2">Medium</option>
                    <option value="1">High</option>
                </select>
            </div>

            {{-- hidden fields --}}
            <input type="hidden" type="text" name="status" id="status" value="pending">

            @foreach($customers as $customer)
                @if($customer->id == $user->customer_id)
                    <input type="hidden" type="text" name="customer_id" id="customer_id" value="{{$customer->id}}">
                    <input type="hidden" type="text" name="user_id" id="user_id" value="{{$user->id}}">
                    <input type="hidden" type="text" name="created_by" id="created_by" value="{{$user->name}}">
                @endif
            @endforeach

            <div class="form-group">
                <input type="submit" value="Create" class="btn btn-primary">
            </div>
        </form>
    @elseif($user->role_id == 1)
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
                <label for="customer_id">Customer</label>
                <select name="customer_id" id="customer_id">
                    @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="prio_level">Prio level</label>
                <select name="prio_level" id="prio_level">
                    <option value="3">Low</option>
                    <option value="2">Medium</option>
                    <option value="1">High</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <input class="form-control" type="file" name="file" id="file">
            </div>

            {{-- hidden fields --}}
            <input type="hidden" type="text" name="status" id="status" value="pending">

            @foreach($customers as $customer)
                @if($customer->id == $user->customer_id)
                    <input type="hidden" type="text" name="user_id" id="user_id" value="{{$user->id}}">
                    <input type="hidden" type="text" name="created_by" id="created_by" value="{{$user->name}}">
                @endif
            @endforeach

            <div class="form-group">
                <input type="submit" value="Create" class="btn btn-primary">
            </div>
        </form>
    @endif
@endsection
