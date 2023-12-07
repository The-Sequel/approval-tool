@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-8">
        <div class="user-row">
            @foreach($users as $user)
                <div class="user-card">
                    <h3>{{$user->name}}</h3>
                    <div class="user-card-body">
                        <div>
                            <p style="background-color: {{$user->color}};" class="user-card-logo">{{substr($user->name, 0, 1)}}</p>
                        </div>
                        <div>
                            <p><span>Naam:</span> {{$user->name}}</p>
                            <p><span>Functie:</span> {{$user->department->title}}</p>
                            <p>{{$user->phone_number}}</p>
                            <p>{{$user->email}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-4">
        <div class="customer-information-card">
            <h3>Algemene gegevens {{$user->customer->name}}</h3>
            <div class="customer-information-address">
                <p>{{$user->customer->address}}</p>
                <p>{{$user->customer->postal_code}}</p>
            </div>
            <div class="customer-information-contact">
                <p>{{$user->customer->phone}}</p>
                <p>{{$user->customer->email}}</p>
            </div>
            <div class="customer-information-more">
                <p>KVK {{$user->customer->kvk}}</p>
                <p>BTW {{$user->customer->btw}}</p>
            </div>
        </div>
        <div class="user-cards">
            <div class="information-card">
                <h3>Gegevens aanpassen?</h3>
                <p>Laten we dit meteen regelen</p>
                <form action="{{route('customer.contact', 3)}}" method="GET">
                    @csrf
                    @method('GET')
                    <button>Dien aanvraag in</button>
                </form>
            </div>
            <div class="new-user-card">
                <h3>Nieuwe gebruiker nodig?</h3>
                <p>Laten we dit meteen regelen</p>
                <form action="{{route('customer.contact', 2)}}" method="GET">
                    @csrf
                    @method('GET')
                    <button>Dien aanvraag in</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection