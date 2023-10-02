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
                    <option value="1">Ik heb een vraag</option>
                    <option value="2">Technisch probleem</option>
                    <option value="3">Ik wil een nieuwe gebruiker aanvragen</option>
                    <option value="4">Ik wil mijn gegevens aanpassen</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message">Bericht</label>
                <textarea name="message" id="message" rows="10"></textarea>
            </div>

            <div class="form-group">
                <button type="submit">Verstuur</button>
            </div>
        </form>
    </div>
</div>
@endsection