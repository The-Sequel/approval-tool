@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-12">
        <form class="search-form" action="{{ route('admin.search.messages') }}" method="GET">
            <div class="search-form-group">
                @if(isset($date))
                    <input type="date" id="date" name="date" class="date" value="{{ $date }}">
                @else
                    <input type="date" id="date" name="date" class="date">
                @endif

                <input type="hidden" id="name" name="name" value="messages"></input>
            </div>

            <button>Zoeken</button>
        </form>
        <form class="search-reset" action="{{route('admin.search.messages')}}" method="GET">
            @csrf
            @method('GET')
            <button>Reset</button>
        </form>

        <button class="filter-button" id="showFilters">Toon filters</button>

        @if(count($messages) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Onderwerp</th>
                        <th>Datum</th>
                        <th>Project/Taak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                        @if($message->customer_id == null)
                            <tr>
                                <td data-label="Onderwerp">{{ $message->name }}</td>
                                <td data-label="Datum">{{ $message->created_at->format('d-m-Y')}}</td>
                                @if($message->task_id == null)
                                    <td data-label="Project/Taak">
                                        <div>
                                            <a href="{{route('admin.projects.show', $message->project_id)}}">
                                                <span style="color: black;" class="material-icons">open_in_new</span></a>
                                        </div>
                                    </td>
                                @elseif($message->project_id == null)
                                    <td data-label="Project/Taak">
                                        <div>
                                            <a href="{{route('admin.tasks.show', $message->task_id)}}">
                                                <span style="color: black;" class="material-icons">open_in_new</span></a>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-content">
                <h3>Geen berichten gevonden</h3>
            </div>
        @endif
    </div>
</div>
@endsection


{{-- <script>
    // on change of the select box, submit the form
    $(document).ready(function() {
        $('select').change(function() {
            $('form').submit();
        });
    });
</script> --}}