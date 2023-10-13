@extends('layouts.app-master')

@section('content')
<div class="grid">
    {{-- @include('sections.table' , $table) --}}
    <div class="col-12">
        <form action="{{route('admin.search.customers')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>
        </form>
        <form action="{{route('admin.customers.index')}}" method="GET">
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
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{route('admin.customers.create')}}" method="GET">
            @csrf 
            @method('GET')
            <div class="form-group">
                <button class="button" type="submit">Maak nieuwe klant</button>
            </div>
        </form>
    </div>
</div>
@endsection
