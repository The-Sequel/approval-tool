@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        @if(count($tasks) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Taak</th>
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
                        <tr>
                            <td data-label="Taak">{{$task->title}}</td>
                            <td data-label="Klant">{{$task->project->customer->name}}</td>
                            <td data-label="Persoon">
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
                            <td data-label="Gemaakt op">{{$task->created_at->format('d-m-Y')}}</td>
                            <td data-label="Bewerkt op">{{$task->updated_at->format('d-m-Y')}}</td>
                            <td data-label="Acties">
                                <form id="delete-form-task" action="{{route('admin.tasks.destroy', $task)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <div class="table-icons">
                                    <a class="table-icons-item" href="{{route('admin.tasks.edit', $task)}}"><span style="color: black;" class="material-icons">edit</span></a>
                                    <a class="table-icons-item" href="#" onclick="event.preventDefault(); deleteTaskPopup();"><span style="color: black;" class="material-icons">delete</span></a>
                                    <a class="table-icons-item" href="{{route('admin.tasks.show', $task)}}"><span style="color: black;" class="material-icons">open_in_new</span></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-content">
                <p>Er zijn geen taken gevonden.</p>
            </div>
        @endif
        <form action='{{route('admin.tasks.project.create', $project)}}' method="GET">
            @csrf
            @method('GET')
            <div class="form-group form-edit-buttons" id="form-group">
                <button type="submit">Maak nieuwe taak</button>
                <button class="delete" onclick="event.preventDefault(); deleteProjectPopup({{$project->id}});">Verwijder project</button>
            </div>
        </form>

        {{-- Hidden forms --}}

        <form id="delete-form-project-{{$project->id}}" action="{{route('admin.projects.destroy', $project)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@include('sections.delete.project')
@include('sections.delete.task')

@endsection
