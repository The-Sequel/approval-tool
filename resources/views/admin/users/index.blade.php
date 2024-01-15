@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form class="search-form" action="{{route('admin.search.users')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                @if(isset($search))
                    <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken" value="{{$search}}">
                @else
                    <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
                @endif
            </div>

            <div class="search-form-group">
                <select name="status" id="status">
                    <option value="">Status</option>
                    @if(isset($status))
                        <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Actief</option>
                        <option value="inactive" {{ $status == 'inactive' ? 'selected' : '' }}>Inactief</option>
                    @else
                        <option value="active">Actief</option>
                        <option value="inactive">Inactief</option>
                    @endif
                </select>
            </div>

            <div class="search-form-group">
                <select name="department" id="department">
                    @if(isset($department_id))
                        <option value="">Afdelingen</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}" {{ $department_id == $department->id ? 'selected' : '' }}>{{$department->title}}</option>
                        @endforeach
                    @else
                        <option value="">Afdelingen</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->title}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="search-form-group">
                <select name="role" id="role">
                    @if(isset($role_id))
                        <option value="">Rollen</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{ $role_id == $role->id ? 'selected' : '' }}>{{ucfirst($role->name)}}</option>
                        @endforeach
                    @else
                        <option value="">Rollen</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <button class="test">Zoeken</button>
        </form>


        <form class="search-reset" action="{{route('admin.users.index')}}" method="GET">
            @csrf
            @method('GET')
            <button>Reset</button>
        </form>

        <button class="filter-button" id="showFilters">Toon filters</button>

        @if(count($users) > 0)
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
                            <td data-label="Gebruikers naam">{{$user['name']}}</td>
                            <td data-label="Email">{{$user['email']}}</td>

                            {{-- Status --}}

                            @if($user['status'] == 'active')
                                <td data-label="Status">
                                    <p class="status-active">Actief</p>
                                </td>
                            @else
                                <td data-label="Status">
                                    <p class="status-inactive">Inactief</p>
                                </td>
                            @endif

                            {{-- Department --}}

                            @if($user['department'])
                                <td data-label="Afdeling">{{$user['department']['title']}}</td>
                            @else
                                <td data-label="Afdeling">-</td>
                            @endif

                            {{-- Customer --}}

                            @if($user['customer'])
                                <td data-label="Klant">{{$user['customer']['name']}}</td>
                            @else
                                <td data-label="Klant">-</td>
                            @endif

                            {{-- Role --}}

                            @if($user['role']['name'] == 'admin')
                                <td data-label="Rol">Admin</td>
                            @else
                                <td data-label="Rol">Klant</td>
                            @endif

                            <td data-label="Acties">
                                <div class="table-icons">
                                    <a class="table-icons-item" href="{{route('admin.users.edit', $user['id'])}}"><span style="color: black;" class="material-icons">edit</span></a>
                                    <a class="table-icons-item" href="#" onclick="deleteUserPopup({{$user['id']}});"><span style="color: black;" class="material-icons">delete</span></a>
                                </div>
                            </td>
                            <form id="delete-form-user-{{$user['id']}}" action="{{route('admin.users.destroy', $user['id'])}}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-content">
                <h3>Er zijn geen gebruikers gevonden.</h3>
            </div>
        @endif
        <form class="create-button" action="{{route('admin.users.create')}}" method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button>Maak nieuwe gebruiker</button>
            </div>
        </form>
    </div>
</div>

@include('sections.success')
@include('sections.delete.user')

@endsection
