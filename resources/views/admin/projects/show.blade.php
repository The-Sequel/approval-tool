@extends('layouts.app-master')

@section('content')
<div class="grid">
    {{-- @include('sections.table' , $table) --}}
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>{{$project->title}}</th>
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
                        <td>{{$task->title}}</td>
                        <td>{{$task->project->customer->name}}</td>
                        <td class="user-logo-main">
                            @foreach($users as $user)
                                @if(in_array($user->id, json_decode($task->assigned_to)))
                                    <div class="user-information">
                                        <p class="user-logo">{{substr($user->name, 0, 1)}}</p>
                                        <span class="user-information-content">
                                            <div class="user-information-content-logo">
                                                <p class="user-logo">{{substr($user->name, 0, 1)}}</p>
                                            </div>
                                            <div class="user-information-content-data">
                                                <p>{{$user->name}}</p>
                                                <p>{{$user->email}}</p>
                                            </div>
                                        </span>
                                    </div>
                                @endif
                            @endforeach
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
                        {{-- @foreach($users as $user)
                            @if($user->id == $task->approved_by)
                                <td>{{$user->name}}</td>
                            @endif
                            @if($task->approved_by == null)
                                <td>-</td>
                            @endif
                        @endforeach --}}
                        <td>{{$task->created_at->format('d-m-Y')}}</td>
                        <td>{{$task->updated_at->format('d-m-Y')}}</td>
                        <td><a href="{{route('admin.tasks.edit', $task)}}">Klik hier</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action='{{route('admin.tasks.project.create', $project)}}' method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button type="submit">Maak nieuwe taak</button>
                <button class="delete" onclick="event.preventDefault(); deleteProject();">Verwijder project</button>
            </div>
        </form>
        <form id="delete-form" action="{{route('admin.projects.destroy', $project)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
    function deleteProject() {
        var result = confirm("Weet je zeker dat je dit project wilt verwijderen? hierbij verwijder je ook alle taken toegewezen aan het project");

        if(result){
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection