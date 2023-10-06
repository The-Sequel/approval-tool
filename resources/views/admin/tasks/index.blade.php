@extends('layouts.app-master')

@section('content')
<div class="grid">
    {{-- @include('sections.table' , $table) --}}
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Taken</th>
                    <th>Klant</th>
                    <th>Persoon</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Akkoord door</th>
                    <th>Gemaakt op:</th>
                    <th>Bewerkt op:</th>
                    <th>Bewerk</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr onclick="window.location.href='{{ route('admin.tasks.show', ['task' => $task]) }}';">
                        <td>{{$task->title}}</a></td>
                        <td>{{$task->customer->name}}</td>
                        <td>
                            @foreach($users as $user)
                                @if(in_array($user->id, json_decode($task->assigned_to)))
                                    {{$user->name}},
                                @endif
                            @endforeach
                        </td>
                        @if($task->deadline == date('Y-m-d', strtotime('+2 days')))
                            <td>{{$task->deadline}}🔥</td>
                        @else
                            <td>{{$task->deadline}}</td>
                        @endif
                        <td>{{$task->status}}</td>
                        @if($task->approved_by == null)
                            <td>-</td>
                        @else
                            <td>{{$task->approved_by}}</td>
                        @endif
                        <td>{{$task->created_at->format('d-m-Y')}}</td>
                        <td>{{$task->updated_at->format('d-m-Y')}}</td>
                        <td style=""><a href="{{route('admin.tasks.edit', $task)}}">Klik hier</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-12">
        <form action='{{route('admin.tasks.create')}}' method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button type="submit">Maak nieuwe taak</button>
            </div>
        </form>
    </div>
</div>
@endsection