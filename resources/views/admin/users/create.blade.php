@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form action="{{route('admin.users.store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name">Naam *</label>
                <input type="text" name="name" id="name" placeholder="Vereist">
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="text" name="email" id="email" placeholder="Vereist">
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord *</label>
                <input type="password" name="password" id="password" placeholder="Vereist">
            </div>

            <div class="form-group">
                <label for="phone_number">Telefoonnummer</label>
                <input type="text" name="phone_number" id="phone_number">
            </div>

            <div class="form-group">
                <label for="color">Logo kleur</label>
                <select name="color" id="color">
                    <option value="">Selecteer een kleur</option>
                    <option value="green">Groen</option>
                    <option value="purple">Paars</option>
                    <option value="crimson">Karmozijnrood</option>
                    <option value="gray">Grijs</option>
                    <option value="indigo">Indigo</option>
                    <option value="chocolate">Bruin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="role">Rol *</label>
                <select name="role_id" id="role_id">
                    <option value="">Selecteer een rol</option>
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="customer_id">Klant *</label>
                <select name="customer_id" id="customer_id">
                    <option value="">Selecteer een klant</option>
                    @foreach ($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="department_id">Afdeling</label>
                <select name="department_id" id="department_id">
                    <option value="">Selecteer een afdeling</option>
                    @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{$department->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button>Maak gebruiker aan</button>
            </div>
        </form>
    </div>
</div>

@include('sections.error')

<script>
    var roleSelect = document.getElementById('role_id');

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
