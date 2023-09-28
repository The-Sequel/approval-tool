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
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr onclick="window.location.href='{{ route('admin.projects.show', ['project' => $project]) }}';">
                        <td style="width: 50%;">{{$project->title}}</td>
                        <td style="width: 50%;">{{$project->customer->name}}</td>
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