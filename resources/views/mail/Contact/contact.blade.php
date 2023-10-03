@extends('layouts.mail')

@section('content')
    @if($mail->subject == 0)
        <h2>{{$mail->user}} heeft een vraag</h2>
    @elseif($mail->subject == 1)
        <h2>{{$mail->user}} heeft een technisch probleem</h2>
    @elseif($mail->subject == 2)
        <h2>{{$mail->user}} wil een nieuwe gebruiker aanvragen</h2>
    @elseif($mail->subject == 3)
        <h2>{{$mail->user}} wil zijn gegevens aanpassen</h2>
    @endif

    <p>{{$mail->message}}</p>

    <p>Klant: {{$mail->customer}}</p>
@endsection