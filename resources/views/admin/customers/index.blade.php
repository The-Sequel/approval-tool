@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form class="search-form" action="{{route('admin.search.customers')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>

            <button>Zoeken</button>
        </form>
        <form class="search-reset" action="{{route('admin.customers.index')}}" method="GET">
            @csrf
            @method('GET')
            <button>Reset</button>
        </form>

        <button class="filter-button" id="showFilters">Toon filters</button>

        @if(count($customers) > 0)
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
                                <p id="customer-name-{{$customer['id']}}">{{$customer['name']}}</p>
                            </td>
                            <td data-label="Logo"><img src="{{ asset('storage/'.$customer['logo']) }}" alt="{{$customer['name']}}" width="50"></td>

                            @if($customer['status'] == 'active')
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
                                    @foreach($users as $user)
                                        @if($user->customer_id == $customer['id'])
                                            @if($user->deleted_at == null)
                                                <a href="mailto:{{$user->email}}">
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
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td data-label="Acties">
                                <div class="table-icons">
                                    <a class="table-icons-item" href="{{route('admin.customers.edit', $customer['id'])}}"><span style="color: black;" class="material-icons">edit</span></a>
                                    <a class="table-icons-item" href="#" onclick="deleteCustomerPopup({{$customer['id']}});"><span style="color: black;" class="material-icons">delete</span></a>
                                </div>
                            </td>
                            <form id="delete-form-customer-{{$customer['id']}}" action="{{route('admin.customers.destroy', $customer['id'])}}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
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

        {{-- @include('sections.create.customer')

        <button onclick="openCustomerPopup();">Maak nieuwe klant</button> --}}
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
