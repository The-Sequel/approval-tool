@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <div class="filter-table">
            <form style="margin-left: 270px;" action="{{route('admin.search.tasks')}}" method="GET">
                @csrf
                @method('GET')
                <div class="search-form-group">
                    <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
                </div>
            </form>
            <form style="margin-left: 270px;" action="{{route('admin.tasks.index')}}" method="GET">
                @csrf
                @method('GET')
                <button>Reset</button>
            </form>
        </div>
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
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->title}}</a></td>
                        <td>{{$task->customer->name}}</td>
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
                                <td>
                                    <p class="deadline">{{ $deadlineDate }} 🔥</p>
                                </td>
                            @else
                                <td>
                                    <p class="deadline">{{ $deadlineDate }}</p>
                                </td>
                            @endif
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
                        <td>{{$task->created_at->format('d-m-Y')}}</td>
                        <td>{{$task->updated_at->format('d-m-Y')}}</td>
                        <td>
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
        {{-- <div class="task-information-index"> --}}
            {{-- Hier moet informatie komen over de taak --}}
        {{-- </div> --}}
    </div>
    <div class="col-12">
        <div class="create-button-table">
            <form style="margin-left: 270px;" action='{{route('admin.tasks.create')}}' method="GET">
                @csrf
                @method('GET')
                <div class="form-group">
                    <button type="submit">Maak nieuwe taak</button>
                </div>
            </form>
        </div>
        
        {{-- Hidden forms --}}
        @if(count($tasks) != 0)
            <form id="delete-form-task" action="{{route('admin.tasks.destroy', $task)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </div>
</div>

@include('sections.success')
@include('sections.delete.task')

@endsection