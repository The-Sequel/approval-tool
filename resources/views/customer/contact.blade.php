@extends('layouts.app-master')

@section('content')
<div class="grid" style="margin-left: 270px;">
    <div class="col-12">
        <form action="{{route('customer.contact.send')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="subject">Onderwerp</label>
                <select name="subject" id="subject">
                    @if($value == 0)
                        <option value="0" selected>Ik heb een vraag</option>
                        <option value="1">Technisch probleem</option>
                        <option value="2">Ik wil een nieuwe gebruiker aanvragen</option>
                        <option value="3">Ik wil mijn gegevens aanpassen</option>
                    @elseif($value == 1)
                        <option value="0">Ik heb een vraag</option>
                        <option value="1" selected>Technisch probleem</option>
                        <option value="2">Ik wil een nieuwe gebruiker aanvragen</option>
                        <option value="3">Ik wil mijn gegevens aanpassen</option>
                    @elseif($value == 2)
                        <option value="0">Ik heb een vraag</option>
                        <option value="1">Technisch probleem</option>
                        <option value="2" selected>Ik wil een nieuwe gebruiker aanvragen</option>
                        <option value="3">Ik wil mijn gegevens aanpassen</option>
                    @elseif($value == 3)
                        <option value="0">Ik heb een vraag</option>
                        <option value="1">Technisch probleem</option>
                        <option value="2">Ik wil een nieuwe gebruiker aanvragen</option>
                        <option value="3" selected>Ik wil mijn gegevens aanpassen</option>
                    @endif
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