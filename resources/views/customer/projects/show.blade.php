@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        @if(count($tasks) > 0)
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
            <form class="search-reset" action="{{route('customer.projects.show', $project->id)}}" method="GET">
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
                        <th>Gemaakt op:</th>
                        <th>Bewerkt op:</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr onclick="redirectToTaskPage('{{ $task->status }}', '{{ $task->id }}')">
                            <td data-label="Taken">{{$task->title}}</td>
                            <td data-label="Personen">
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
                                $deadlineDate = null;
                                if ($task->deadline != null) {
                                    $today = strtotime(date('Y-m-d'));
                                    $taskDeadline = strtotime($task->deadline);
                                    $daysDifference = round(($taskDeadline - $today) / (60 * 60 * 24));

                                    // Check if strtotime was successful before using the date
                                    if ($taskDeadline !== false) {
                                        $deadlineDate = date('d-m-Y', $taskDeadline);
                                    }
                                }
                            @endphp

                            @if($task->deadline != null)
                                @if($daysDifference <= 5)
                                    <td data-label="Deadline">
                                        <p class="deadline">{{ $deadlineDate }} 🔥</p>
                                    </td>
                                @else
                                    <td data-label="Deadline">
                                        <p class="deadline-without">{{ $deadlineDate }}</p>
                                    </td>
                                @endif
                            @else
                                <td data-label="Deadline">-</td>
                            @endif


                            
                            @if($task->status == 'pending')
                                <td data-label="Status">
                                    <p class="status-pending">In afwachting</p>
                                </td>
                            @elseif($task->status == 'completed')
                                <td data-label="Status">
                                    <p class="status-completed">Afgerond</p>
                                </td>
                            @elseif($task->status == 'approved')
                                <td data-label="Status">
                                    <p class="status-approved">Akkoord</p>
                                </td>
                            @elseif($task->status == 'denied')
                                <td data-label="Status">
                                    <p class="status-denied">Afgekeurd</p>
                                </td>
                            @endif
                            @if($task->approved_by == null)
                                <td data-label="Akkoord door">-</td>
                            @else
                                @foreach($normalUsers as $user)
                                    @if($user->id == $task->approved_by)
                                        <td data-label="Akkoord door">{{$user->name}}</td>
                                    @endif
                                @endforeach
                            @endif
                            <td data-label="Gemaakt op">{{$task->created_at}}</td>
                            <td data-label="Bewerkt op">{{$task->updated_at}}</td>
                            <td data-label="Acties">
                                <div class="table-icons">
                                    <a class="table-icons-item" href="{{route('customer.tasks.show', $task)}}" target="_blank"><span style="color: black;" class="material-icons">open_in_new</span></a>
                                    @if($task->status == 'completed')
                                        <a class="table-icons-item" href="{{route('customer.tasks.approve', $task)}}" target="_blank"><span style="color: black;" class="material-icons">check_circle</span></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-content">
                <h3>Er zijn geen taken gevonden.</h3>
            </div>
        @endif
    </div>
</div>

@include('sections.error')
@include('sections.success')

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