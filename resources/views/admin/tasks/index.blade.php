@extends('layouts.app-master')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>Taken</th>
                <th>Klant</th>
                <th>Persoon</th>
                <th>Deadline</th>
                <th>Afdeling</th>
                <th>Status</th>
                <th>Akoord door</th>
                <th>Bewerkt op:</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->customer->name }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>{{ $task->deadline }}</td>
                    <td>{{ $task->department }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        @if($task->approved_by == null)
                            -
                        @else
                            {{ $task->approved_by }}
                        @endif
                    </td>
                    <td>
                        @if($task->updated_at == null)
                            -
                        @else
                            {{ $task->updated_at }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form>
        Nieuwe taak
    </form>
    
    <button onclick="">Maak een nieuwe taak aan</button>

    <script>
        
    </script>
@endsection