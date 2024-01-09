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
                <label for="customer_id">Klant *</label>
                <select name="customer_id" id="customer_id">
                    <option value="">Selecteer een klant</option>
                    @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
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

            <input type="hidden" type="text" name="status" id="status" value="pending">
            <input type="hidden" type="text" name="created_by" id="created_by" value="{{Auth::user()->id}}">

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
@endsection
