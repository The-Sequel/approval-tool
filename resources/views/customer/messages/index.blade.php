@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Onderwerp</th>
                    <th>Datum</th>
                    <th>Afdeling</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    @if($message->customer_id == Auth::user()->customer_id)
                        <tr>
                            <td>{{$message->name}}</td>
                            <td>{{$message->created_at}}</td>
                            <td>{{$message->department->title}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection