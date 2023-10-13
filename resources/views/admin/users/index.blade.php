@extends('layouts.app-master')

@section('content')
<div class="grid">
    {{-- @include('sections.table' , $table) --}}
    <div class="col-12">
        <form action="{{route('admin.search.users')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>
        </form>
        <form action="{{route('admin.users.index')}}" method="GET">
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
                        <td>{{$user->status}}</td>
                        {{-- Check if department not null --}}
                        @if($user->department)
                            <td>{{$user->department->title}}</td>
                        @else
                            <td>-</td>
                        @endif
                        @if($user->customer)
                            <td>{{$user->customer->name}}</td>
                        @else
                            <td>-</td>
                        @endif
                        <td>{{$user->role->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{route('admin.users.create')}}" method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button>Maak nieuwe gebruiker</button>
            </div>
        </form>
    </div>
</div>
@endsection