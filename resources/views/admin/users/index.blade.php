@extends('layouts.app-master')

@section('content')
<div class="grid">
    @include('sections.table' , $table);
    <div class="col-12">
            
    </div>
    <form action="{{route('admin.users.create')}}" method="GET">
        @csrf
        @method('GET')
        <div class="form-group">
            <button>Maak</button>
        </div>
    </form>
</div>
@endsection