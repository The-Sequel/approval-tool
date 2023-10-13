@extends('layouts.app-master')

@section('content')
    <form action="{{route('admin.customers.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Naam</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="Vereist">
        </div>

        <div class="form-group">
            <label for="name">Logo</label>
            <input class="form-control" type="file" name="logo" id="logo">
        </div>

        <div class="form-group">
            <label for="name">Adres</label>
            <input class="form-control" type="text" name="address" id="address" placeholder="Optioneel">
        </div>

        <div class="form-group">
            <label for="name">Postcode</label>
            <input class="form-control" type="text" name="postal_code" id="postal_code" placeholder="Optioneel">
        </div>

        <div class="form-group">
            <label for="name">Plaats</label>
            <input class="form-control" type="text" name="city" id="city" placeholder="Optioneel">
        </div>

        <div class="form-group">
            <label for="name">Telefoonnummer</label>
            <input class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Optioneel">
        </div>

        <div class="form-group">
            <label for="name">Email</label>
            <input class="form-control" type="text" name="email" id="email" placeholder="Optioneel">
        </div>

        <div class="form-group">
            <label for="name">KVK nummer</label>
            <input class="form-control" type="text" name="kvk_number" id="kvk_number" placeholder="Optioneel">
        </div>

        <div class="form-group">
            <label for="name">BTW nummer</label>
            <input class="form-control" type="text" name="btw_number" id="btw_number" placeholder="Optioneel">
        </div>
            

        <div class="form-group">
            <button>Maak nieuwe klant</button>
        </div>
    </form>
@endsection