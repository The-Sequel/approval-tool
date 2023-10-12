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
                                    <span class="user-logo">{{substr($user->name, 0, 1)}}</span>
                                @endif
                            @endforeach
                        </td>
                        <td>{{$project->deadline}}</td>
                        <td>{{$project->department->title}}</td>
                        <td>{{$project->status}}</td>
                        @if($project->approved_by == null)
                            <td>-</td>
                        @else
                            <td>{{$project->approved_by}}</td>
                        @endif
                        <td>{{$project->created_at->format('d-m-Y')}}</td>
                        <td>{{$project->updated_at->format('d-m-Y')}}</td>
                        <td><a href="{{route('admin.projects.edit', $project)}}">Klik hier</a></td>
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
    </div>
</div>
@endsection