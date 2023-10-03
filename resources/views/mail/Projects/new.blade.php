@extends('layouts.mail')

@section('content')
    <h2>Nieuw project!</h2>
    <p>Er is een nieuw <a href="{{route('customer.projects.show', $project->id)}}">project</a> aangemaakt!</p>

    <img src="{{asset('storage/'.$project->customer->logo)}}" alt="Avatar" style="width:200px; height:200px; border-radius: 50%; margin-top: 50px;">
@endsection