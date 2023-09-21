@extends('layouts.app-master')

@section('content')
    {{-- Table and other content --}}

    <table class="table">
        <thead>
            <tr>
                <th>Klanten</th>
                <th>Logo</th>
                <th>Status</th>
                <th>Contact personen</th>
                <th>Debiteur nummer</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr onclick="customerInformation('{{$customer->id}}', '{{$customer->name}}', '{{$customer->logo}}', '{{$customer->status}}', '{{$customer->debor_number}}', '{{$customer->users}}')">
                    <td style="width: 50%;" id="customer-name-{{$customer->id}}">{{$customer->name}}</td>
                    <td><img src="{{ asset('storage/'.$customer->logo) }}" alt="{{$customer->name}}" width="50"></td>
                    {{-- <td style="width: 15%;" id="customer-logo"><img src="{{ asset($customer->logo) }}" alt="{{$customer->name}}" width="50"></td> --}}
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
                    {{-- <td>
                        <form action="{{route('admin.customers.destroy', $customer)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="display: block;" class="card-customer-create">
        <h3>Nieuwe klant aanmaken</h3>
        <p>Laten we dit meteen regelen</p>
        <form action="{{route('admin.customers.create')}}" method="GET">
            @csrf 
            @method('GET')
            <button type="submit">Create customer</button>
        </form>
    </div>
@endsection

{{-- css --}}

<style>
    /* .customerSidebar{
        display: flex;
    }

    .customerSidebar button {
        height: 100%;
        width: 10%;
        border-radius: 5px;
        border: none;
        background-color: #e6e6e6;
        cursor: pointer;
    } */

    /* Table */

    .table{
        width: 50%;
        height: 50%;
        margin-left: 1rem;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    .table tr {
        height: 10px;
    }

    .table th{
        padding: 1rem;
        text-align: left;
        border: 1px solid #e6e6e6;
    }

    .table td{
        font-weight: normal;
        cursor: pointer;
        padding: 1rem;
        text-align: left;
        border: 1px solid #e6e6e6;
    }

    .card-customer-create{
        width: 250px;
        height: 120px;
        margin-left: 50px;
        margin-right: 80px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        background-color: #f5f5f5;
        float: left; /* Ensure the card floats to the left */
    }

    /* .card{
        width: 20%;
        height: 30vh;
        margin-left: 2px;
        border: 1px solid #e6e6e6;
    }

    .card-table{
        border-collapse: collapse;
    }

    .card-table th{
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #e6e6e6;
        border-right: 1px solid #e6e6e6;
        font-family: Arial, Helvetica, sans-serif; 
    }

    .card-table td{
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #e6e6e6;
        border-right: 1px solid #e6e6e6;
        font-family: Arial, Helvetica, sans-serif; 
    } */
</style>

</html>