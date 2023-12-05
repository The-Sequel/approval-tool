@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form class="search-form" action="{{route('admin.search.projects')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>
        </form>
        <form class="search-reset" action="{{route('admin.projects.index')}}" method="GET">
            @csrf
            @method('GET')
            <button>Reset</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Projecten</th>
                    <th>Klant</th>
                    <th>Personen</th>
                    <th>Deadline</th>
                    <th>Afdelingen</th>
                    <th>Status</th>
                    <th>Akkoord door</th>
                    <th>Gemaakt op</th>
                    <th>Bewerkt op</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td data-label="Projecten">{{$project->title}}</td>
                        <td data-label="Klant">{{$project->customer->name}}</td>
                        <td data-label="Personen">
                            <div class="user-logo-main">
                                @foreach($users as $user)
                                    @if($user->customer_id == $project->customer_id)
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
                            if ($project->deadline != null) {
                                $today = strtotime(date('Y-m-d'));
                                $projectDeadline = strtotime($project->deadline);
                                $daysDifference = round(($projectDeadline - $today) / (60 * 60 * 24));

                                // Check if strtotime was successful before using the date
                                if ($projectDeadline !== false) {
                                    $deadlineDate = date('d-m-Y', $projectDeadline);
                                }
                            }
                        @endphp

                        @if($project->deadline != null)
                            @if($daysDifference <= 5)
                                <td id="deadline" data-label="Deadline">
                                    <p class="deadline">{{ $deadlineDate }} 🔥</p>
                                </td>
                            @else
                                <td data-label="Deadline">
                                    <p class="deadline">{{ $deadlineDate }}</p>
                                </td>
                            @endif
                        @endif


                        <td data-label="Afdelingen">
                            <p class="department">{{$project->department->title}}</p>
                        </td>
                        <td data-label="Status">
                            @if($project->status == 'pending')
                                <p class="status-pending">In afwachting</p>
                            @elseif($project->status == 'completed')
                                <p class="status-completed">Afgerond</p>
                            @elseif($project->status == 'approved')
                                <p class="status-approved">Akkoord</p>
                            @elseif($project->status == 'denied')
                                <p class="status-denied">Afgekeurd</p>
                            @endif
                        </td>
                        @if($project->approved_by == null)
                            <td data-label="Akkoord door">-</td>
                        @else
                            <td data-label="Akkoord door">{{$project->approved_by}}</td>
                        @endif
                        <td data-label="Gemaakt op">{{$project->created_at->format('d-m-Y')}}</td>
                        <td data-label="Bewerkt op">{{$project->updated_at->format('d-m-Y')}}</td>
                        <td data-label="Acties">
                            <div class="table-icons">
                                <a class="table-icons-item" href="{{route('admin.projects.edit', $project)}}"><span style="color: black;" class="material-icons">edit</span></a>
                                <a class="table-icons-item" href="#" onclick="event.preventDefault(); deleteProjectPopup();"><span style="color: black;" class="material-icons">delete</span></a>
                                <a class="table-icons-item" href="{{route('admin.projects.show', $project)}}" target="_blank"><span style="color: black;" class="material-icons">open_in_new</span></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form class="create-button" action="{{route('admin.projects.create')}}" method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button type="submit">Maak nieuw project</button>
            </div>
        </form>

        @if(count($projects) != 0)
            <form id="delete-form-project" action="{{route('admin.projects.destroy', $project)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </div>
</div>

@include('sections.success')
@include('sections.delete.project')

@endsection
