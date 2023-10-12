@extends('layouts.app-master')

@section('content')
<div class="grid">
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
                    <th>Personen</th>
                    <th>Deadline</th>
                    <th>Afdeling</th>
                    <th>Status</th>
                    <th>Akkoord door</th>
                    <th>Bewerkt op:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr onclick="window.location.href='{{ route('customer.projects.show', ['project' => $project]) }}';">
                        <td>{{$project->title}}</td>
                        <td class="user-logo-main">
                            @foreach($project->customer->users as $user)
                                @if($user->deleted_at == null)
                                    <span class="user-logo">{{substr($user->name, 0, 1)}}</span>
                                @endif
                            @endforeach
                        </td>
                        <td>{{$project->deadline}}</td>
                        <td>{{$project->department->title}}</td>
                        @if($project->status == 'pending')
                            <td>In afwachting</td>
                        @elseif($project->status == 'completed')
                            <td>Afgerond</td>
                        @elseif($project->status == 'approved')
                            <td>Akkoord</td>
                        @elseif($project->status == 'declined')
                            <td>Afgekeurd</td>
                        @endif
                        @if($project->approved_by == null)
                            <td>-</td>
                        @else
                            <td>{{$project->approved_by}}</td>
                        @endif
                        <td>{{$project->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection