@php
    use Illuminate\Support\Str;
    $route = Request::path();
@endphp

<div class="add-user-popup" id="add-user-popup">
    <div class="text-container">
        <span onclick="closeAddUsersToTaskPopup()" class="material-symbols-outlined close-button">
            close
        </span>

        <div id="title">
            <h2>Voeg gebruikers toe aan taak</h2>
        </div>

        <div id="users">
            @foreach($users as $user)
                @if($user->status == 'active')
                    @if(Str::contains($route, 'admin/tasks/create/') || Str::contains($route, 'admin/tasks/create'))
                        <input type="checkbox" name="user_ids[]" id="user_id_{{$user->id}}" value="{{$user->id}}">
                        {{$user->name}} <br>
                    @else
                        @if(in_array($user->id, $assignedUsers))
                            <input type="checkbox" name="user_ids[]" id="user_id_{{$user->id}}" value="{{$user->id}}" checked>
                            {{$user->name}} <br>
                        @else
                            <input type="checkbox" name="user_ids[]" id="user_id_{{$user->id}}" value="{{$user->id}}">
                            {{$user->name}} <br>
                        @endif
                    @endif
                @endif
            @endforeach
        </div>

        <button onclick="event.preventDefault(); addUsersToTask();">Voeg toe</button>
    </div>
</div>
{{-- Script --}}

<script>
    function addUsersToTask(){
        document.getElementById('add-user-form').submit();
    }

    function closeAddUsersToTaskPopup(){
        document.querySelector('.add-user-popup .text-container').style.visibility = 'hidden';
    }
</script>