@extends('layouts.app-master')

@section('content')
<div class="grid">
    {{-- @include('sections.table' , $table) --}}
    <div class="col-12">
        <form action="{{route('admin.search.tasks')}}" method="GET">
            @csrf
            @method('GET')
            <div class="search-form-group">
                <input type="text" name="search" id="search" class="search-form-input" placeholder="Zoeken">
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Taken</th>
                    <th>Klant</th>
                    <th>Persoon</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Akkoord door</th>
                    <th>Gemaakt op:</th>
                    <th>Bewerkt op:</th>
                    <th>Bewerk</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr onclick="window.location.href='{{ route('admin.tasks.show', ['task' => $task]) }}';">
                        <td>{{$task->title}}</a></td>
                        <td>{{$task->customer->name}}</td>
                        <td class="user-logo-main">
                            @foreach($users as $user)
                                @if(in_array($user->id, json_decode($task->assigned_to)))
                                <span class="user-logo">{{substr($user->name, 0, 1)}}</span>
                                @endif
                            @endforeach
                        </td>
                        @if($task->deadline == date('Y-m-d', strtotime('+2 days')))
                            <td>{{$task->deadline}}🔥</td>
                        @else
                            <td>{{$task->deadline}}</td>
                        @endif
                        @if($task->status == 'pending')
                            <td>In afwachting</td>
                        @elseif($task->status == 'completed')
                            <td>Afgerond</td>
                        @elseif($task->status == 'approved')
                            <td>Akkoord</td>
                        @elseif($task->status == 'denied')
                            <td>Afgekeurd</td>
                        @endif

                        @if($task->approved_by == null)
                            <td>-</td>
                        @else
                            @foreach($normalUsers as $user)
                                @if($user->id == $task->approved_by)
                                    <td>{{$user->name}}</td>
                                @endif
                            @endforeach
                        @endif
                        <td>{{$task->created_at->format('d-m-Y')}}</td>
                        <td>{{$task->updated_at->format('d-m-Y')}}</td>
                        <td style=""><a href="{{route('admin.tasks.edit', $task)}}">Klik hier</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-12">
        <form action='{{route('admin.tasks.create')}}' method="GET">
            @csrf
            @method('GET')
            <div class="form-group">
                <button type="submit">Maak nieuwe taak</button>
            </div>
        </form>
    </div>
</div>
@endsection