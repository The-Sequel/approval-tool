@extends('layouts.app-master')

@section('content')
<div class="grid">
    @include('sections.table' , $table);
    <div class="col-12">
        <form action='{{route('admin.tasks.create')}}' method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button type="submit">Maak</button>
            </div>
        </form>
    </div>
</div>
@endsection