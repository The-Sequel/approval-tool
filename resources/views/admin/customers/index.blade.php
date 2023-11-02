@extends('layouts.app-master')

@section('content')
<div class="grid">
    {{-- @include('sections.table' , $table) --}}
    <div class="col-12">
        <form style="margin-left: 270px;" action="{{route('admin.search.customers')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>
        </form>
        <form style="margin-left: 270px;" action="{{route('admin.customers.index')}}" method="GET">
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
                    <tr onclick="window.location.href='{{ route('admin.customers.edit', ['customer' => $customer]) }}';">

                        <td>
                            <p id="customer-name-{{$customer->id}}">{{$customer->name}}</p>
                        </td>
                        <td><img src="{{ asset('storage/'.$customer->logo) }}" alt="{{$customer->name}}" width="50"></td>

                        @if($customer->status == 'active')
                            <td id="customer-status">
                                <p class="status-active">Actief</p>
                            </td>
                        @else
                            <td id="customer-status">
                                <p class="status-inactive">Non-Actief</p>
                            </td>
                        @endif
                        
                        <td>
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
                        <td>
                            <div class="table-icons">
                                <a class="table-icons-item" href="{{route('admin.customers.edit', $customer)}}"><span style="color: black;" class="material-icons">edit</span></a>
                                <a class="table-icons-item" href="#" onclick="deleteCustomerPopup();"><span style="color: black;" class="material-icons">delete</span></a>

                                {{-- <a class="table-icons-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></a> --}}
                                {{-- <a class="table-icons-item" href="#" onclick="event.preventDefault(); deleteProjectPopup();"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/></svg></a> --}}
                                {{-- <a class="table-icons-item" href="#" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z"/></svg></a> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form style="margin-left: 270px;" action="{{route('admin.customers.create')}}" method="GET">
            @csrf 
            @method('GET')
            <div class="form-group">
                <button class="button" type="submit">Maak nieuwe klant</button>
            </div>
        </form>

        <form id="delete-form-customer" action="{{route('admin.customers.destroy', $customer)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>

        {{-- Dit is een optie maar dit hoeft niet gebruikt te worden dit is nog in de maak --}}

        <div style="margin-left: 270px;" class="create-project">
            <p onclick="toggleFormVisibility()">hover over dit element</p>
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
        </div>
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
