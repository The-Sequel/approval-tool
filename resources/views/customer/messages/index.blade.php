@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Onderwerp</th>
                    <th>Project/Taak</th>
                    <th>Datum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    @if($message->customer_id == Auth::user()->customer_id)
                        <tr>
                            <td>{{$message->name}}</td>
                            @if($message->task_id == null)
                                <td><a href="{{route('customer.projects.show', $message->project_id)}}">Klik hier</a></td>
                            @elseif($message->project_id == null)
                                <td><a href="{{route('customer.projects.show', $message->task_id)}}">Klik hier</a></td>
                            @endif
                            <td>{{$message->created_at}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection