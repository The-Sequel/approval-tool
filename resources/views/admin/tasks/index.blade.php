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
                    <th>Afdeling</th>
                    <th>Status</th>
                    <th>Akkoord door</th>
                    <th>Bewerkt op:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    @if($task->status != 'approved')
                        <tr onclick="window.location.href='{{ route('admin.tasks.show', ['task' => $task]) }}';">
                            <td>{{$task->title}}</a></td>
                            <td>{{$task->customer->name}}</td>
                            <td>{{$task->user->name}}</td>
                            @if($task->deadline == date('Y-m-d', strtotime('+2 days')))
                                <td>{{$task->deadline}}🔥</td>
                            @else
                                <td>{{$task->deadline}}</td>
                            @endif
                            <td>{{$task->department->title}}</td>
                            <td>{{$task->status}}</td>
                            @if($task->approved_by == null)
                                <td>-</td>
                            @else
                                <td>{{$task->approved_by}}</td>
                            @endif
                            <td>{{$task->updated_at}}</td>
                        </tr>
                    @endif
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