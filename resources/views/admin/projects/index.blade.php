@extends('layouts.app-master')

@section('content')
<div class="grid">
    @include('sections.table' , $table)
    <div class="col-12">
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
                    <th>Bewerkt op:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr onclick="window.location.href='{{ route('admin.projects.show', ['project' => $project]) }}';">
                        <td>{{$project->title}}</td>
                        <td>{{$project->customer->name}}</td>
                        <td></td>
                        <td>{{$project->deadline}}</td>
                        <td>{{$project->department->title}}</td>
                        <td>{{$project->status}}</td>
                        <td>{{$project->approved_by}}</td>
                        <td>{{$project->updated_at}}</td>
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