@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form class="search-form" action="{{route('customer.search.projects')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>

            <div class="search-form-group">
                @if(isset($date))
                    <input type="date" id="date" name="date" class="date" value="{{ $date }}">
                @else
                    <input type="text" id="date" name="date" class="date" placeholder="Zoeken op gemaakt op"
                    onfocus="(this.type='date')"
                    onblur="(this.type='text')">
                @endif
            </div>

            <div class="search-form-group">
                @if(isset($dealine))
                    <input type="date" id="deadline" name="deadline" class="date" value="{{ $deadline }}">
                @else
                    <input type="text" id="deadline" name="deadline" class="date" placeholder="Zoeken op deadline"
                    onfocus="(this.type='date')"
                    onblur="(this.type='text')">
                @endif
            </div>

            <div class="search-form-group">
                <select name="status" id="status">
                    <option value="">Status</option>
                    @if(isset($status))
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>In afwachting</option>
                        <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Afgerond</option>
                        <option value="approved" {{ $status == 'approved' ? 'selected' : '' }}>Akkoord</option>
                        <option value="denied" {{ $status == 'denied' ? 'selected' : '' }}>Afgekeurd</option>
                    @else
                        <option value="pending">In afwachting</option>
                        <option value="completed">Afgerond</option>
                        <option value="approved">Akkoord</option>
                        <option value="denied">Afgekeurd</option>
                    @endif
                </select>
            </div>

            <div class="search-form-group">
                <select name="department" id="department">
                    <option value="">Afdeling</option>
                    @foreach($departments as $department)
                        @if(isset($departmentChoice))
                            @if($department->id == $departmentChoice['id'])
                                <option selected value="{{$department['id']}}">{{$department['title']}}</option>
                            @else
                                <option value="{{$department['id']}}">{{$department['title']}}</option>
                            @endif
                        @else
                            <option value="{{$department['id']}}">{{$department['title']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button>Zoeken</button>
        </form>

        <form class="search-reset" action="{{route('admin.projects.index')}}" method="GET">
            @csrf
            @method('GET')
            <button>Reset</button>
        </form>

        <button class="filter-button" id="showFilters">Toon filters</button>
        
        @if(count($projects) > 0)
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
                            <td data-label="Projecten">{{$project['title']}}</td>
                            <td data-label="Personen">
                                <div class="user-logo-main">
                                    @foreach($users as $user)
                                        @if($user->customer_id == $project['customer']['id'])
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
                                if ($project['deadline'] != null) {
                                    $today = strtotime(date('Y-m-d'));
                                    $projectDeadline = strtotime($project['deadline']);
                                    $daysDifference = round(($projectDeadline - $today) / (60 * 60 * 24));

                                    // Check if strtotime was successful before using the date
                                    if ($projectDeadline !== false) {
                                        $deadlineDate = date('d-m-Y', $projectDeadline);
                                    }
                                }
                            @endphp

                            @if($project['deadline'] != null)
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

                            <td data-label="Afdeling">
                                <p class="department">{{$project['department']['title']}}</p>
                            </td>

                            @if($project['status'] == 'pending')
                                <td data-label="status">
                                    <p class="status-pending">In afwachting</p>
                                </td>
                            @elseif($project['status'] == 'completed')
                                <td data-label="status">
                                    <p class="status-completed">Afgerond</p>
                                </td>
                            @elseif($project['status'] == 'approved')
                                <td data-label="status">
                                    <p class="status-approved">Akkoord</p>
                                </td>
                            @elseif($project['status'] == 'declined')
                                <td data-label="status">
                                    <p class="status-denied">Afgekeurd</p>
                                </td>
                            @endif
                            @if($project['approved_by'] == null)
                                <td data-label="Akkoord door">-</td>
                            @else
                                <td data-label="Akkoord door">{{$project['approved_by']}}</td>
                            @endif
                            <td data-label="Gemaakt op">{{date('d-m-Y', strtotime($project['created_at']))}}</td>
                            <td data-label="Bewerkt op">{{date('d-m-Y', strtotime($project['updated_at']))}}</td>
                            <td data-label="Acties">
                                <div>
                                    <a class="table-icons-item" href="{{route('customer.projects.show', $project['id'])}}"><span style="color: black;" class="material-icons">open_in_new</span></a>
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
