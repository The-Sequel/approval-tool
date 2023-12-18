@extends('layouts.mail')

@section('content')
    <h2>Nieuwe gebruiker!</h2>
    <p>Bedankt voor het kiezen van <span style="color: green;">The Sequel!</span></p>
    <p>Gebruikers naam: {{$user->name}}</p>
    <p>Email: {{$user->email}}</p>
    <p>Wachtwoord: {{$user->password}}</p>

    {{-- Put a reset password link here --}}
    <a href="{{route('password.request')}}">Reset password</a>

    <img src="{{asset('storage/'.$user->customer->logo)}}" alt="Avatar" style="width:200px; height:200px; border-radius: 50%; margin-top: 50px;">
@endsection