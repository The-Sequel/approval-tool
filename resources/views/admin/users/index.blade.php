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
    </div>
</div>
@endsection