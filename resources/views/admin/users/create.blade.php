@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form action="{{route('admin.users.store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="role">Rol</label>
                <select name="role_id" id="role_id">
                    <option value="">Selecteer een rol</option>
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="customer_id">Klant</label>
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

<script>
    var roleSelect = document.getElementById('role_id');
    // var customerSelect = document.getElementById('customer_id');

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

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approval Tool</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <form action="{{route('admin.users.store')}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <input type="submit" value="Create" class="btn btn-primary">
        </div>
    </form>
</body>
</html> --}}