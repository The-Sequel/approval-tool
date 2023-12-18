@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        @if(count($projects) > 0)
            <form class="search-form" action="{{route('customer.search.projects')}}" method="GET">
                @csrf
                @method('GET')
                <div class="search-form-group">
                    <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
                </div>
            </form>
            <form class="search-reset" action="{{route('customer.projects.index')}}" method="GET">
                @csrf
                @method('GET')
                <button>Reset</button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Projecten</th>
                        <th>Personen</th>
                        <th>Deadline</th>
                        <th>Afdeling</th>
                        <th>Status</th>
                        <th>Akkoord door</th>
                        <th>Gemaakt op:</th>
                        <th>Bewerkt op:</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td data-label="Projecten">{{$project->title}}</td>
                            <td data-label="Personen">
                                <div class="user-logo-main">
                                    @foreach($project->customer->users as $user)
                                        @if($user->deleted_at == null)
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
                                    <td data-label="Deadline">
                                        <p class="deadline">{{ $deadlineDate }} 🔥</p>
                                    </td>
                                @else
                                    <td data-label="Deadline">
                                        <p class="deadline">{{ $deadlineDate }}</p>
                                    </td>
                                @endif
                            @endif

                            <td data-label="Afdeling">
                                <p class="department">{{$project->department->title}}</p>
                            </td>

                            @if($project->status == 'pending')
                                <td data-label="status">
                                    <p class="status-pending">In afwachting</p>
                                </td>
                            @elseif($project->status == 'completed')
                                <td data-label="status">
                                    <p class="status-completed">Afgerond</p>
                                </td>
                            @elseif($project->status == 'approved')
                                <td data-label="status">
                                    <p class="status-approved">Akkoord</p>
                                </td>
                            @elseif($project->status == 'declined')
                                <td data-label="status">
                                    <p class="status-denied">Afgekeurd</p>
                                </td>
                            @endif
                            @if($project->approved_by == null)
                                <td data-label="Akkoord door">-</td>
                            @else
                                <td data-label="Akkoord door">{{$project->approved_by}}</td>
                            @endif
                            <td data-label="Gemaakt op">{{date('d-m-Y', strtotime($project->created_at))}}</td>
                            <td data-label="Bewerkt op">{{date('d-m-Y', strtotime($project->updated_at))}}</td>
                            <td data-label="Acties">
                                <div>
                                    <a class="table-icons-item" href="{{route('customer.projects.show', $project)}}"><span style="color: black;" class="material-icons">open_in_new</span></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-content">
                <h3>Er zijn geen projecten gevonden.</h3>
            </div>
        @endif
    </div>
</div>
@endsection
