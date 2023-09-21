@extends('layouts.app-master')

@section('content')
    <form action="{{route('admin.customers.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Naam</label>
            <input class="form-control" type="text" name="name" id="name">
        </div>

        {{-- <div class="form-group">
            <label for="name">Status</label>
            <select class="form-control" name="status">
                <option></option>
                <option value="active">Active</option>
                <option value="inactive">Non-actief</option>
            </select>
        </div> --}}

        <div class="form-group">
            <label for="name">Logo</label>
            <input class="form-control" type="file" name="logo" id="logo">
        </div>

        <div class="form-group">
            <label for="name">Debiteur nummer</label>
            <input class="form-control" type="text" name="debtor_number" id="debtor_number">
        </div>
            

        <div class="form-group">
            <input type="submit" value="Create" class="btn btn-primary">
        </div>
    </form>
@endsection