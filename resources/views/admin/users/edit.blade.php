@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form action="{{route('admin.users.update', $user)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name" value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="{{$user->email}}">
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="phone_number">Telefoonnummer</label>
                <input type="text" name="phone_number" id="phone_number" value="{{$user->phone_number}}">
            </div>

            <div class="form-group">
                <label for="color">Logo kleur</label>
                <select name="color" id="color">
                    <option value="">Selecteer een kleur</option>
                    <option value="green" @if($user->color == 'green') selected @endif>Groen</option>
                    <option value="purple" @if($user->color == 'purple') selected @endif>Paars</option>
                    <option value="crimson" @if($user->color == 'crimson') selected @endif>Karmozijnrood</option>
                    <option value="gray" @if($user->color == 'gray') selected @endif>Grijs</option>
                    <option value="indigo" @if($user->color == 'indigo') selected @endif>Indigo</option>
                    <option value="chocolate" @if($user->color == 'chocolate') selected @endif>Bruin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    @if($user->status == 'active')
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    @else
                        <option value="inactive" selected>Inactive</option>
                        <option value="active">Active</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="role">Rol</label>
                <select name="role_id" id="role_id">
                    <option value="{{$user->role->id}}">{{ ucfirst($user->role->name)}}</option>
                    @foreach ($roles as $role)
                        @if($role->id != $user->role->id)
                            <option value="{{$role->id}}">{{ ucfirst($role->name) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="customer_id">Klant</label>
                <select name="customer_id" id="customer_id">
                    @if($user->customer != null)
                        <option value="{{$user->customer->id}}">{{$user->customer->name}}</option>
                        @foreach ($customers as $customer)
                            @if($customer->id != $user->customer->id)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endif
                        @endforeach
                    @else
                        <option value="">Selecteer een klant</option>
                        @foreach ($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="department_id">Afdeling</label>
                <select name="department_id" id="department_id">
                    @if($user->department != null)
                        <option value="{{$user->department->id}}">{{$user->department->title}}</option>
                        @foreach ($departments as $department)
                            @if($department->id != $user->department->id)
                                <option value="{{$department->id}}">{{$department->title}}</option>
                            @endif
                        @endforeach
                    @else
                        <option value="">Selecteer een afdeling</option>
                        @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->title}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group form-edit-buttons">
                <button>Bewerk gebruiker</button>
                {{-- put prevent default on this button --}}
                <button class="delete" onclick="event.preventDefault(); deleteUserPopup({{$user->id}});">Verwijder gebruiker</button>
            </div>
        </form>
        <form id="delete-form-user-{{$user->id}}" action="{{route('admin.users.destroy', $user)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@include('sections.delete.user')

<script>
    var roleSelect = document.getElementById('role_id');

    document.addEventListener('DOMContentLoaded', function() {
        var roleSelect = document.getElementById('role_id');

        var selectedRoleId = roleSelect.value;

        if(selectedRoleId == 1){
            document.getElementById('customer_id').disabled = true;
            document.getElementById('department_id').disabled = true;
        } else {
            document.getElementById('customer_id').disabled = false;
            document.getElementById('department_id').disabled = false;
        }
    });


    roleSelect.addEventListener('change', function() {
        var selectedRoleId = this.value;

        if(selectedRoleId == 1){
            document.getElementById('customer_id').disabled = true;
            document.getElementById('department_id').disabled = true;
        } else {
            document.getElementById('customer_id').disabled = false;
            document.getElementById('department_id').disabled = false;
        }
    })
</script>
@endsection