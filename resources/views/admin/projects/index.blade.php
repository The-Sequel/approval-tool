@extends('layouts.app-master')

@section('content')
<div class="grid">
    @include('sections.table' , $table);
    <div class="col-12">
        
    </div>
    <form action="" method="GET">
        @csrf
        @method('GET')
        <button type="submit">+ Create user</button>
    </form>
</div>
<p>Projects</p>
@endsection