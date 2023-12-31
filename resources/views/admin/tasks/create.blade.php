@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form action="{{route('admin.tasks.store')}}" method="POST" enctype="multipart/form-data">
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

            <div>
                <p style="margin-bottom: 8px;">Voeg gebruikers toe aan taak</p>
                @foreach($users as $user)
                    <input type="checkbox" name="user_ids[]" id="user_id_{{$user->id}}" value="{{$user->id}}">
                    {{$user->name}} <br>
                @endforeach
            </div>

            <div style="margin-bottom: 20px; margin-top: 20px;">
                <input type="checkbox" name="send_mail" id="send_mail">
                <label for="send_mail">Stuur mail</label>
            </div>

            <input type="hidden" type="text" name="status" id="status" value="pending">
            <input type="hidden" type="text" name="created_by" id="created_by" value="{{Auth::user()->id}}">

            <div class="form-group">
                <button>Maak nieuwe taak</button>
            </div>
        </form>
    </div>
</div>

@include('sections.error')



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
