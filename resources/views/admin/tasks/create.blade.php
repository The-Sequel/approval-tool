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
        <label for="customer_id">Klant</label>
        <select name="customer_id" id="customer_id">
            <option value="">Selecteer een klant</option>
            @foreach($customers as $customer)
                <option value="{{$customer->id}}">{{$customer->name}}</option>
            @endforeach
        </select>
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
    <input type="hidden" type="text" name="user_id" id="user_id" value={{Auth::user()->id}}>`

    <div class="form-group">
        <button>Maak nieuwe taak</button>
    </div>
</form>

{{-- <script>
    var customerSelect = document.getElementById('customer_id');

    document.addEventListener('DOMContentLoaded', function() {
        var roleSelect = document.getElementById('customer_id');

        var selectedRoleId = roleSelect.value;

        if(selectedRoleId == 1){
            document.getElementById('project_id').disabled = true;
        } else {
            document.getElementById('project_id').disabled = false;
        }
    });

    customerSelect.addEventListener('change', function() {
        var selectedCustomerId = this.value;

        if(selectedCustomerId == '') {
            document.getElementById('project_id').disabled = true;
        } else {
            document.getElementById('project_id').disabled = false;
        }

    })
</script> --}}

{{-- <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data">
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
    </div> --}}

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