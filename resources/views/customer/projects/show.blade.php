@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Taken</th>
                    <th>Personen</th>
                    <th>Deadline</th>
                    <th>Afdeling</th>
                    <th>Status</th>
                    <th>Akkoord door</th>
                    <th>Bewerkt op:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    {{-- <tr onclick="@if($task->status === 'completed') window.location.href='{{ route('customer.tasks.approve', ['task' => $task]) }}';" @else onclick="window.location.href='{{ route('customer.tasks.show', ['task' => $task])}}' @endif"> --}}
                    <tr onclick="redirectToTaskPage('{{ $task->status }}', '{{ $task->id }}')">
                        <td>{{$task->title}}</td>
                        <td >
                            @foreach($task->customer->users as $user)
                                {{$user->name}},
                            @endforeach
                        </td>
                        <td>{{$task->deadline}}</td>
                        <td>{{$task->department->title}}</td>
                        @if($task->status == 'pending')
                            <td>In afwachting</td>
                        @elseif($task->status == 'completed')
                            <td>Afgerond</td>
                        @elseif($task->status == 'approved')
                            <td>Akkoord</td>
                        @elseif($task->status == 'denied')
                            <td>Afgekeurd</td>
                        @endif
                        @if($task->approved_by == null)
                            <td>-</td>
                        @else
                            <td>{{$task->approved_by}}</td>
                        @endif
                        <td>{{$task->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function redirectToTaskPage(status, taskId) {
        if (status === 'completed') {
            window.location.href = '{{ route('customer.tasks.approve', ['task' => ':taskId']) }}'.replace(':taskId', taskId);
        } else {
            window.location.href = '{{ route('customer.tasks.show', ['task' => ':taskId']) }}'.replace(':taskId', taskId);
        }
    }
</script>
@endsection