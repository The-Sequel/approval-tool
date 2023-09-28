@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form action="{{route('admin.customers.update', $customer)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name" value="{{$customer->name}}">
            </div>

            <div class="form-group">
                <label for="name">Logo</label>
                <input class="form-control" type="file" name="logo" id="logo">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                    @if($customer->status == 'active')
                        <option value="active" selected>Actief</option>
                        <option value="inactive">Non-Actief</option>
                    @else
                        <option value="active">Actief</option>
                        <option value="inactive" selected>Non-Actief</option>
                    @endif
                </select>
            </div>
        
            <div class="form-group">
                <label for="debtor_number">Debiteur nummer</label>
                <input type="text" class="form-control" name="debtor_number" id="debtor_number" value="{{$customer->debtor_number}}">
            </div>

            <div class="form-group">
                <button>Bewerk gebruiker</button>
            </div>
        </form>
    </div>
</div>
@endsection