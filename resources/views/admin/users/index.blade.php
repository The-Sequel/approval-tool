@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form class="search-form" action="{{route('admin.search.users')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>
        </form>
        <form class="search-reset" action="{{route('admin.users.index')}}" method="GET">
            @csrf
            @method('GET')
            <button>Reset</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Gebruikers naam</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Afdeling</th>
                    <th>Klant</th>
                    <th>Rol</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td data-label="Gebruikers naam">{{$user->name}}</td>
                        <td data-label="Email">{{$user->email}}</td>

                        {{-- Status --}}

                        @if($user->status == 'active')
                            <td data-label="Status">
                                <p class="status-completed">Actief</p>
                            </td>
                        @else
                            <td data-label="Status">Inactief</td>
                        @endif

                        {{-- Department --}}

                        @if($user->department)
                            <td data-label="Afdeling">{{$user->department->title}}</td>
                        @else
                            <td data-label="Afdeling">-</td>
                        @endif

                        {{-- Customer --}}

                        @if($user->customer)
                            <td data-label="Klant">{{$user->customer->name}}</td>
                        @else
                            <td data-label="Klant">-</td>
                        @endif

                        {{-- Role --}}

                        @if($user->role->name == 'admin')
                            <td data-label="Rol">Admin</td>
                        @else
                            <td data-label="Rol">Klant</td>
                        @endif

                        <td data-label="Acties">
                            <div class="table-icons">
                                <a class="table-icons-item" href="{{route('admin.users.edit', $user)}}"><span style="color: black;" class="material-icons">edit</span></a>
                                <a class="table-icons-item" href="#" onclick="deleteUserPopup();"><span style="color: black;" class="material-icons">delete</span></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form class="create-button" action="{{route('admin.users.create')}}" method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button>Maak nieuwe gebruiker</button>
            </div>
        </form>

        @if(count($users) > 0)
            <form id="delete-form-user" action="{{route('admin.users.destroy', $user)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </div>
</div>

@include('sections.success')
@include('sections.delete.user')

@endsection
