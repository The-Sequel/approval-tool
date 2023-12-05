@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form action="{{route('customer.contact.send')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="subject">Onderwerp</label>
                <select name="subject" id="subject">
                    <option value="0" @selected( $value == 0 )>Ik heb een vraag</option>
                    <option value="1" @selected( $value == 1 )>Technisch probleem</option>
                    <option value="2" @selected( $value == 2 )>Ik wil een nieuwe gebruiker aanvragen</option>
                    <option value="3" @selected( $value == 3 )>Ik wil mijn gegevens aanpassen</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message">Bericht</label>
                <textarea name="message" id="message" rows="10"></textarea>
            </div>

            <input type="hidden" name="user" value="{{Auth::user()->name}}">
            <input type="hidden" name="customer" value="{{Auth::user()->customer->name}}">

            <div class="form-group">
                <button type="submit">Verstuur</button>
            </div>
        </form>
    </div>
</div>
@endsection
