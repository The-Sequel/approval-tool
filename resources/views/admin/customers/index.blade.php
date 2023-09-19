<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approval Tool</title>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
</head>
<body>
    <div class="container">

        {{-- Sidebar --}}

        <div class="sidebar">
            <img width="200" height="122" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" data-ll-status="loaded">
            <ul>
                <a href="{{route('admin.index')}}"><li>Dashboard</li></a>
                <div class="customerSidebar">
                    <a href="{{route('admin.customers.index')}}"><li>Klanten</li></a><button onclick="createCustomer()" style="height: 50%; width: 10%;">+</button>
                </div>
                <a id="create-customer" style="display: none;" href="{{route('admin.customers.create')}}"><li>Klant aanmaken</li></a>
                {{-- The list items under this comment still need to be finished --}}
                <li>Projecten</li>
                <li>Taken</li>
                <li>Berichten</li>
                <li>Deadlines</li>
            </ul>
        </div>

        {{-- Header --}}
        <div class="header">
            <h1>Dashboard</h1>
        </div>

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
    </div>
</body>


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
    *{
        margin: 0;
        padding: 0;
    }

    /* Header */

    /* .header{
        background-color: #f5f5f5;
        padding: 1rem;
        text-align: center;
    } */

    /* Sidebar */

    .sidebar{
        background-color: #f5f5f5;
        height: 100vh;
        width: 250px;
        padding: 1rem;
        resize: none;
        float: left;
    }

    .sidebar ul a{
        list-style: none;
        text-decoration: none;
        font-family: Arial, Helvetica, sans-serif;
        color: black;
    }

    .sidebar ul li{
        padding: 1rem;
        cursor: pointer;
        /* These 2 under this comment can be removed when all of the other <a> elements are fixed */
        list-style: none;
        font-family: Arial, Helvetica, sans-serif; 
    }

    .sidebar ul li:hover{
        background-color: #e6e6e6;
        border-radius: 5px;
    }

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

    /* Change name of container1 to container */

    .container{
        display: flex;
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