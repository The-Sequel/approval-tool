@extends('layouts.app-master')

@section('content')
<div class="grid">
    {{-- @include('sections.table' , $table) --}}
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
                    <tr onclick="window.location.href='{{ route('admin.users.edit', ['user' => $user]) }}';">
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

                                {{-- <a class="table-icons-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></a> --}}
                                {{-- <a class="table-icons-item" href="#" onclick="event.preventDefault(); deleteProjectPopup();"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/></svg></a> --}}
                                {{-- <a class="table-icons-item" href="#" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z"/></svg></a> --}}
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