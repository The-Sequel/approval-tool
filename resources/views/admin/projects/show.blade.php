@extends('layouts.app-master')

@section('content')
<div class="grid">
    {{-- @include('sections.table' , $table) --}}
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>{{$project->title}}</th>
                    <th>Klant</th>
                    <th>Persoon</th>
                    <th>Deadline</th>
                    <th>Afdeling</th>
                    <th>Status</th>
                    <th>Akkoord door</th>
                    <th>Bewerkt op:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr onclick="window.location.href='{{ route('admin.tasks.show', ['task' => $task]) }}';">
                        <td>{{$task->title}}</td>
                        <td>{{$task->project->customer->name}}</td>
                        <td class="user-logo">\
                            {{-- @if ($task->assigned_to)
                                @foreach($task->assigned_to as $user)
                                    {{ substr($user->name, 0, 1) }}
                                @endforeach
                            @else
                                No users assigned.
                            @endif --}}
                            {{-- @foreach($task->assigned_to as $user)
                                {{substr($user->name, 0, 1)}}
                            @endforeach --}}
                        </td>
                        <td>{{$task->deadline}}</td>
                        <td>{{$task->department->title}}</td>
                        <td>{{$task->status}}</td>
                        @if($task->approved_by == null)
                            <td>-</td>
                        @else
                            <td>{{$task->approved_by}}</td>
                        @endif
                        <td>{{$task->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action='{{route('admin.tasks.project.create', $project)}}' method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button type="submit">Maak nieuwe taak</button>
                <button class="delete" onclick="event.preventDefault(); deleteProject();">Verwijder project</button>
                <button onclick="event.preventDefault(); finishProject();">Voltooi project</button>
            </div>
        </form>
        <form id="delete-form" action="{{route('admin.projects.destroy', $project)}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
        <form id="complete-form" action="{{route('admin.projects.finish', $project)}}" method="POST">
            @csrf
            @method('POST')
        </form>
    </div>
</div>

<script>
    function deleteProject() {
        var result = confirm("Weet je zeker dat je dit project wilt verwijderen? hierbij verwijder je ook alle taken toegewezen aan het project");

        if(result){
            document.getElementById('delete-form').submit();
        }
    }

    function finishProject() {
        document.getElementById('complete-form').submit();
    }
</script>
@endsection

{{-- @extends('layouts.app-master')

@section('content')
<div class="grid">
    @include('sections.table' , $table);
    <div class="col-12">
        
    </div>
</div>
@endsection --}}