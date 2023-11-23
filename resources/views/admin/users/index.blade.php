@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form style="margin-left: 270px;" action="{{route('admin.search.users')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>
        </form>
        <form style="margin-left: 270px;" action="{{route('admin.users.index')}}" method="GET">
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
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>

                        {{-- Status --}}

                        @if($user->status == 'active')
                            <td>
                                <p class="status-completed">Actief</p>
                            </td>
                        @else
                            <td>Inactief</td>
                        @endif

                        {{-- Department --}}

                        @if($user->department)
                            <td>{{$user->department->title}}</td>
                        @else
                            <td>-</td>
                        @endif

                        {{-- Customer --}}

                        @if($user->customer)
                            <td>{{$user->customer->name}}</td>
                        @else
                            <td>-</td>
                        @endif

                        {{-- Role --}}

                        @if($user->role->name == 'admin')
                            <td>Admin</td>
                        @else
                            <td>Klant</td>
                        @endif

                        <td>
                            <div class="table-icons">
                                <a class="table-icons-item" href="{{route('admin.users.edit', $user)}}"><span style="color: black;" class="material-icons">edit</span></a>
                                <a class="table-icons-item" href="#" onclick="deleteUserPopup();"><span style="color: black;" class="material-icons">delete</span></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form style="margin-left: 270px;" action="{{route('admin.users.create')}}" method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button>Maak nieuwe gebruiker</button>
            </div>
        </form>
        <form id="delete-form-user" action="{{route('admin.users.destroy', $user)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@include('sections.success')
@include('sections.delete.user')

@endsection
