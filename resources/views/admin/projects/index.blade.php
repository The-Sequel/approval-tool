@extends('layouts.app-master')

@section('content')
<div class="grid">
    {{-- @include('sections.table' , $table) --}}
    <div class="col-12">
        <form action="{{route('customer.search.projects')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>
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
                    <th>Gemaakt op:</th>
                    <th>Bewerkt op:</th>
                    <th>Bewerk</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr onclick="window.location.href='{{ route('admin.projects.show', ['project' => $project]) }}';">
                        <td>{{$project->title}}</td>
                        <td>{{$project->customer->name}}</td>
                        <td class="user-logo-main">
                            @foreach($users as $user)
                                @if($user->customer_id == $project->customer_id)
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
                        <td>
                            <p class="deadline">{{$project->deadline}}</p>
                        </td>
                        <td>
                            <p class="department">{{$project->department->title}}</p>
                        </td>
                        <td>
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
                            <td>-</td>
                        @else
                            <td>{{$project->approved_by}}</td>
                        @endif
                        <td>{{$project->created_at->format('d-m-Y')}}</td>
                        <td>{{$project->updated_at->format('d-m-Y')}}</td>
                        <td class="table-icons">
                            <a class="table-icons-item" href="{{route('admin.projects.edit', $project)}}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></a>
                            {{-- <a class="table-icons-item" id="destroy-project"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/></svg></a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{route('admin.projects.create')}}" method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button type="submit">Maak nieuw project</button>
            </div>
        </form>

        {{-- Hidden form --}}
        {{-- <form id="destroy-project-form" action="{{route('admin.projects.destroy', $project)}}" method="POST">
            @csrf
            @method('DELETE')
        </form> --}}
    </div>
</div>

<script>
    document.querySelectorAll('td:last-child').forEach(td => {
        td.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });
</script>
@endsection