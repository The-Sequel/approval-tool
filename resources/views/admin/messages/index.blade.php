@extends('layouts.app-master')

@section('content')
<div class="grid">
    {{-- @include('sections.table' , $table); --}}
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Onderwerp</th>
                    <th>Datum</th>
                    <th>Afdeling</th>
                    <th>Tijd</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    {{-- @dd($message); --}}
                    <tr>
                        <td><span>{{ $message->name }}!</span> Voor {{$message->task->title}}</td>
                        <td>{{ $message->created_at }}</td>
                        <td>{{ $message->department->title }}</td>
                        <td>{{ $message->created_at->format('d-m-Y')}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection