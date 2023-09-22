@extends('layouts.app-master')

@section('content')
<div class="grid">
    @include('sections.table' , $table);
    <div class="col-12">
        {{-- <table class="table">
            <thead>
                <tr>
                    <th>Klanten</th>
                    <th>Logo</th>
                    <th>Status</th>
                    <th>Contact personen</th>
                    <th>Debiteur nummer</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr onclick="customerInformation('{{$customer->id}}', '{{$customer->name}}', '{{$customer->logo}}', '{{$customer->status}}', '{{$customer->debor_number}}', '{{$customer->users}}')">
                        <td style="width: 50%;" id="customer-name-{{$customer->id}}">{{$customer->name}}</td>
                        <td><img src="{{ asset('storage/'.$customer->logo) }}" alt="{{$customer->name}}" width="50"></td>
                        @if($customer->status == 'active')
                            <td id="customer-status"><p style="border-radius: 5px; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px; background-color: rgb(0, 255, 0); text-color: rgb(75, 226, 75);">Actief</p></td>
                        @else
                        <td id="customer-status"><p style="border-radius: 5px; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px; background-color: red; text-color: rgb(75, 226, 75);">Non-Actief</p></td>
                        @endif
                        <td style="width: 15%;">
                            @foreach($customer->users as $user)
                                <p>{{$user->name}}</p>
                            @endforeach
                        </td>
                        <td style="width: 20%;">{{$customer->debtor_number}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
        {{-- <div class="button-customer-create">
            <form action="{{route('admin.customers.create')}}" method="GET">
                @csrf 
                @method('GET')
                <button type="submit">+ Create customer</button>
            </form>
        </div> --}}
    </div>
</div>
    {{-- Table and other content --}}

    {{-- <div style="display: block;" class="card-customer-create">
        <h3>Nieuwe klant aanmaken</h3>
        <p>Laten we dit meteen regelen</p>
        <form action="{{route('admin.customers.create')}}" method="GET">
            @csrf 
            @method('GET')
            <button type="submit">Create customer</button>
        </form>
    </div> --}}
@endsection

{{-- css --}}

<style>


    .button-customer-create{
        margin-left: 1rem;
        margin-top: 50px;
        /* padding-left: */
        /* box-shadow: 0 0 10px rgba(0,0,0,0.2);
        background-color: #f5f5f5; */
        /* float: left; */
    }

    .button-customer-create button{
        padding-left: 10px;
        padding-right: 10px;
    }

</style>
