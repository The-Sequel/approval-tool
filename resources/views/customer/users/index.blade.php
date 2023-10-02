@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-8">
        {{-- Put 3 users here --}}
        @foreach($users as $user)
            <div class="user-card">
                {{$user->name}}
                {{-- Phone number --}}
            </div>
        @endforeach
    </div>
    <div class="col-4">
        <div class="customer-information-card">
            <h3>Algemene gegevens {{$user->customer->name}}</h3>
            <div class="customer-information-address">
                <p>Adres: {{$user->customer->address}}</p>
                <p>Postcode: {{$user->customer->postal_code}}</p>
            </div>
            <div class="customer-information-contact">
                <p>Telefoonnummer: {{$user->customer->phone_number}}</p>
                <p>Email: {{$user->customer->email}}</p>
            </div>
            <div class="customer-information-more">
                <p>KVK nummer: {{$user->customer->kvk_number}}</p>
                <p>BTW nummer: {{$user->customer->btw_number}}</p>
            </div>
        </div>
        <div class="user-cards">
            <div class="information-card">
                <h3>Gegevens aanpassen?</h3>
                <p>Laten we dit meteen regelen</p>
                <form action="{{route('customer.contact')}}" method="GET">
                    @csrf
                    @method('GET')
                    <button>Dien aanvraag in</button>
                </form>
            </div>
            <div class="new-user-card">
                <h3>Nieuwe gebruiker nodig?</h3>
                <p>Laten we dit meteen regelen</p>
                <form action="{{route('customer.contact')}}" method="GET">
                    @csrf
                    @method('GET')
                    <button>Dien aanvraag in</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .user-card {
        height: 150px;
        width: 300px;
        margin: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>
@endsection