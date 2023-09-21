@extends('layouts.app-master')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Gebruikers naam</th>
                <th>Email</th>
                <th>Customer</th>
                <th>Rol</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <form action="{{route('admin.users.update', $user)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="customer_id">
                                <option value="" selected></option>
                                @foreach($customers as $customer)
                                    @if($customer->id != $user->customer_id)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @else
                                        <option value="{{$customer->id}}" selected>{{$customer->name}}</option> 
                                    @endif
                                @endforeach
                            </select>
                            <td>
                                <select name="role_id">
                                    <option value="" selected></option>
                                    @foreach($roles as $role)
                                        @if($role->id != $user->role_id)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @else
                                            <option value="{{$role->id}}" selected>{{$role->name}}</option> 
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="submit" value="Update" class="btn btn-success">
                                
                                {{-- <form action="{{route('admin.users.destroy', $user)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                </form> --}}
                            </td>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection