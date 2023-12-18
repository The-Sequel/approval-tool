@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        @if(count($customers) > 0)
            <form class="search-form" action="{{route('admin.search.customers')}}" method="GET">
                @csrf
                @method('GET')
                <div class="search-form-group">
                    <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
                </div>
            </form>
            <form class="search-reset" action="{{route('admin.customers.index')}}" method="GET">
                @csrf
                @method('GET')
                <button>Reset</button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Klanten</th>
                        <th>Logo</th>
                        <th>Status</th>
                        <th>Contact personen</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td data-label="Klanten">
                                <p id="customer-name-{{$customer->id}}">{{$customer->name}}</p>
                            </td>
                            <td data-label="Logo"><img src="{{ asset('storage/'.$customer->logo) }}" alt="{{$customer->name}}" width="50"></td>

                            @if($customer->status == 'active')
                                <td data-label="Status" id="customer-status">
                                    <p class="status-active">Actief</p>
                                </td>
                            @else
                                <td data-label="Status" id="customer-status">
                                    <p class="status-inactive">Non-Actief</p>
                                </td>
                            @endif

                            <td data-label="Contact personen">
                                <div class="user-logo-main">
                                    @foreach($customer->users as $user)
                                        @if($user->deleted_at == null)
                                            <div class="user-information">
                                                <p style="background-color: {{$user->color}};" class="user-logo">{{substr($user->name, 0, 1)}}</p>
                                                <span class="user-information-content">
                                                    <div class="user-information-content-logo">
                                                        <p style="background-color: {{$user->color}};" class="user-logo">{{substr($user->name, 0, 1)}}</p>
                                                    </div>
                                                    <div class="user-information-content-data">
                                                        <p>{{$user->name}}</p>
                                                        <p>{{$user->email}}</p>
                                                    </div>
                                                </span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td data-label="Acties">
                                <div class="table-icons">
                                    <a class="table-icons-item" href="{{route('admin.customers.edit', $customer)}}"><span style="color: black;" class="material-icons">edit</span></a>
                                    <a class="table-icons-item" href="#" onclick="deleteCustomerPopup();"><span style="color: black;" class="material-icons">delete</span></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-content">
                <h3>Geen klanten gevonden</h3>
            </div>
        @endif
        <form class="create-button" action="{{route('admin.customers.create')}}" method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button class="button" type="submit">Maak nieuwe klant</button>
            </div>
        </form>

        @if(count($customers) > 0)
            <form id="delete-form-customer" action="{{route('admin.customers.destroy', $customer)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        @endif


        {{-- Dit is een optie maar dit hoeft niet gebruikt te worden dit is nog in de maak --}}

        {{-- <div style="margin-left: 270px;" class="create-project">
            <span class="create-project-content">
                <div class="create-project-content-data">
                    <form action="{{route('admin.customers.store')}}" method="POST" enctype="multipart/form-data" id="customer-form">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="name">Naam</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Vereist">
                        </div>
                        <div class="form-group">
                            <label for="name">Logo</label>
                            <input class="form-control" type="file" name="logo" id="logo">
                        </div>
                        <div class="form-group">
                            <label for="name">Adres</label>
                            <input class="form-control" type="text" name="address" id="address" placeholder="Optioneel">
                        </div>

                        <div class="form-group">
                            <label for="name">Postcode</label>
                            <input class="form-control" type="text" name="postal_code" id="postal_code" placeholder="Optioneel">
                        </div>

                        <div class="form-group">
                            <label for="name">Plaats</label>
                            <input class="form-control" type="text" name="city" id="city" placeholder="Optioneel">
                        </div>

                        <div class="form-group">
                            <label for="name">Telefoonnummer</label>
                            <input class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Optioneel">
                        </div>

                        <div class="form-group">
                            <label for="name">Email</label>
                            <input class="form-control" type="text" name="email" id="email" placeholder="Optioneel">
                        </div>

                        <div class="form-group">
                            <label for="name">KVK nummer</label>
                            <input class="form-control" type="text" name="kvk_number" id="kvk_number" placeholder="Optioneel">
                        </div>

                        <div class="form-group">
                            <label for="name">BTW nummer</label>
                            <input class="form-control" type="text" name="btw_number" id="btw_number" placeholder="Optioneel">
                        </div>

                        <div class="">
                            <button onclick="submitCustomerForm();">Maak nieuwe klant</button>
                        </div>
                    </form>
                </div>
            </span>
        </div> --}}
    </div>
</div>

@include('sections.success')
@include('sections.delete.customer')

@endsection


<script>

    function toggleFormVisibility(){
        var form = document.querySelector('.create-project-content')
        visibility = form.style.visibility;

        if(visibility == 'hidden') {
            form.style.visibility = 'visible';
        } else {
            form.style.visibility = 'hidden';
        }
    }

    function submitCustomerForm() {
        event.preventDefault();
        // console.log('test');
        document.getElementById('customer-form').submit();
    }
</script>
