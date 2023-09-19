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
                    <td style="width: 15%;" id="customer-logo"><img src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" alt="{{$customer->name}}" width="50"></td>
                    @if($customer->status == 'active')
                        <td style="width: 15%;" id="customer-status"><span>Actief</span></td>
                    @else
                        <td style="width: 15%;" id="customer-status"><span>Non-actief</span></td>
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
    <div class="card" style="display: none;">
        {{-- Put contract information here --}}
        <p id="name" style="font-weight: normal;"></p>
        <img id="logo" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" alt="customer-logo">
        <table class="card-table">
            <thead>
                <tr>
                    <th>Contracten</th>
                    <th>Uren per maand</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contracts as $contract)
                    @if($contract->customer_id == $customer->id)
                        <tr>
                            <td>{{$contract->name}}</td>
                            <td>{{$contract->hours}}</td>
                            @if($contract->status == 'active')
                                <td><span>Actief</span></td>
                            @else
                                <td><span>Non-actief</span></td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <form action="{{route('admin.contracts.create')}}" method="GET">
            @csrf
            @method('GET')
            {{-- If this input is deleted no contracts will be shown anymore --}}
            {{-- Don't remove this input --}}
            <input type="text" name="customer_id" id="customer_id" value="" hidden>
            <button type="submit">Add contract</button>
        </form>
        <h4>Contact personen</h4>
    </div>
@endsection


{{-- script --}}

<script>
    // This function displays the customer information
    // function customerInformation(id, name, logo, status, debtor_number, users) {
    //     var infoDiv = document.querySelector('.card');
    //     var createCustomerCard = document.querySelector('.card-customer-create');
    
    //     if (infoDiv.style.display === 'block') {
    //         if(document.getElementById('name').innerHTML == name){
    //             infoDiv.style.display = 'none';
    //             createCustomerCard.style.display = 'block';
    //             // document.getElementById('customer-name-' + i).style = 'font-weight: normal;';
    //         }
    //     } else {
    //         infoDiv.style.display = 'block';
    //         createCustomerCard.style.display = 'none';
    //         // document.getElementById('customer-name').style = 'font-weight: bold;';
    //     }

    //     // if (createCustomerCard.style.display === 'block') {
    //     //     createCustomerCard.style.display = 'none';
    //     // } else {
    //     //     createCustomerCard.style.display = 'block';
    //     // }

    //     var name = name;
    //     var logo = logo;
    //     var status = status;
    //     var debtor_number = debtor_number;
    //     var users = users;

    //     // document.getElementById('name').innerHTML = name;
    //     // document.getElementById('logo').src = logo;
    //     // document.getElementById('customer-status').innerHTML = status;
    //     // document.getElementById('customer_id').value = id;


    //     displayContractsForCustomer(id);
    // }

    // // This function displays the contracts for the customer

    // function displayContractsForCustomer(customerId) {
    //     var contracts = {!! json_encode($contracts) !!}; // Assuming $contracts is the PHP array of contracts

    //     var contractsTable = document.querySelector('.card table tbody');
    //     contractsTable.innerHTML = '';

    //     for (var i = 0; i < contracts.length; i++) {
    //         if (contracts[i].customer_id == customerId) {
    //             var row = contractsTable.insertRow();
    //             var cell1 = row.insertCell(0);
    //             var cell2 = row.insertCell(1);
    //             var cell3 = row.insertCell(2);
    //             cell1.innerHTML = contracts[i].name;
    //             cell2.innerHTML = contracts[i].hours;
    //             cell3.innerHTML = contracts[i].status;
    //         }
    //     }
    // }

    // This function is for the button that creates a customer

    function createCustomer(){
        var createCustomer = document.getElementById('create-customer');
        if (createCustomer.style.display === 'block') {
            createCustomer.style.display = 'none';
        } else {
            createCustomer.style.display = 'block';
        }
    }

    function createCustomerCard(){
        var createCustomerCard = document.getElementById('create-customer-card');
        if (createCustomerCard.style.display === 'block') {
            createCustomerCard.style.display = 'none';
        } else {
            createCustomerCard.style.display = 'block';
        }
    }

</script>

{{-- css --}}

<style>
    .customerSidebar{
        display: flex;
    }

    .customerSidebar button {
        height: 100%;
        width: 10%;
        border-radius: 5px;
        border: none;
        background-color: #e6e6e6;
        cursor: pointer;
    }

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