@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form action="{{route('customer.search.tasks')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>
            <input type="hidden" name="project_id" value="{{$project->id}}">
        </form>
        {{-- <form action="{{route('customer.status.tasks')}}" method="GET">
            @csrf
            @method('GET')
            <select>
                <option value="pending">In afwachting</option>
                <option value="completed">Afgerond</option>
                <option value="approved">Akkoord</option>
                <option value="denied">Afgekeurd</option>
            </select>

            <input type="hidden" name="project_id" value="{{$project->id}}">

            <button>Filter</button>
        </form> --}}
        <form action="{{route('customer.projects.show', $project->id)}}" method="GET">
            @csrf
            @method('GET')
            <button>Reset</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Taken</th>
                    <th>Personen</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Akkoord door</th>
                    <th>Bewerkt op:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr onclick="redirectToTaskPage('{{ $task->status }}', '{{ $task->id }}')">
                        <td>{{$task->title}}</td>
                        <td>
                            <div class="user-logo-main">
                                @foreach($users as $user)
                                    @if(in_array($user->id, json_decode($task->assigned_to)))
                                        <div class="user-information">
                                            <p style="background-color: {{$user->color}};" class="user-logo">{{substr($user->name, 0, 1)}}</p>
                                            <span class="user-information-content">
                                                <div class="user-information-content-logo">
                                                    <p style="background-color: {{$user->color}};" class="user-logo">{{substr($user->name, 0, 1)}}</p>
                                                </div>
                                                <div class="user-information-content-data">
                                                    <p>{{$user->name}}</p>
                                                    <p>{{$user->email}}</p>
                                                </div>
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </td>

                        {{-- Deadline --}}

                        @php
                            $today = strtotime(date('Y-m-d'));
                            $taskDeadline = strtotime($task->deadline);
                            $daysDifference = round(($taskDeadline - $today) / (60 * 60 * 24));
                        @endphp
                        @if($daysDifference <= 5)
                            <td>
                                <p class="deadline">{{$task->deadline}}</p><span>🔥</span>
                            </td>
                        @else
                            <td>
                                <p class="deadline">{{$task->deadline}}</p>
                            </td>
                        @endif


                        
                        @if($task->status == 'pending')
                            <td>
                                <p class="status-pending">In afwachting</p>
                            </td>
                        @elseif($task->status == 'completed')
                            <td>
                                <p class="status-completed">Afgerond</p>
                            </td>
                        @elseif($task->status == 'approved')
                            <td>
                                <p class="status-approved">Akkoord</p>
                            </td>
                        @elseif($task->status == 'denied')
                            <td>
                                <p class="status-denied">Afgekeurd</p>
                            </td>
                        @endif
                        @if($task->approved_by == null)
                            <td>-</td>
                        @else
                            @foreach($normalUsers as $user)
                                @if($user->id == $task->approved_by)
                                    <td>{{$user->name}}</td>
                                @endif
                            @endforeach
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
        if (status === 'completed' || status === 'denied') {
            console.log('redirecting to approve page');
            window.location.href = '{{ route('customer.tasks.approve', ['task' => ':taskId']) }}'.replace(':taskId', taskId);
        } else {
            console.log('redirecting to task page');
            window.location.href = '{{ route('customer.tasks.show', ['task' => ':taskId']) }}'.replace(':taskId', taskId);
        }
    }
</script>
@endsection