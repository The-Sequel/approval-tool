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
                <label for="name">Adres</label>
                <input class="form-control" type="text" name="address" id="address" placeholder="Optioneel" value="{{$customer->address}}">
            </div>
    
            <div class="form-group">
                <label for="name">Postcode</label>
                <input class="form-control" type="text" name="postal_code" id="postal_code" placeholder="Optioneel" value="{{$customer->postal_code}}">
            </div>
    
            <div class="form-group">
                <label for="name">Plaats</label>
                <input class="form-control" type="text" name="city" id="city" placeholder="Optioneel" value="{{$customer->city}}">
            </div>
    
            <div class="form-group">
                <label for="name">Telefoonnummer</label>
                <input class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Optioneel" value="{{$customer->phone}}">
            </div>
    
            <div class="form-group">
                <label for="name">Email</label>
                <input class="form-control" type="text" name="email" id="email" placeholder="Optioneel" value="{{$customer->email}}">
            </div>
    
            <div class="form-group">
                <label for="name">KVK nummer</label>
                <input class="form-control" type="text" name="kvk_number" id="kvk_number" placeholder="Optioneel" value="{{$customer->kvk}}">
            </div>
    
            <div class="form-group">
                <label for="name">BTW nummer</label>
                <input class="form-control" type="text" name="btw_number" id="btw_number" placeholder="Optioneel" value="{{$customer->btw}}">
            </div>

            <div class="form-group form-edit-buttons" id="form-group">
                <button>Bewerk klant</button>
                <button class="delete" onclick="event.preventDefault(); deleteCustomerPopup();">Verwijder klant</button>
            </div>
        </form>
        
        <form id="delete-form-customer" action="{{route('admin.customers.destroy', $customer)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@include('sections.delete.customer')

{{-- <script>
    function deleteCustomer() {
        var result = confirm("Weet je zeker dat je deze klant wilt verwijderen?");

        if(result){
            document.getElementById('delete-form').submit();
        }
    }
</script> --}}
@endsection