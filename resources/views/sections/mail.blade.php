<div class="mail-popup">
    <div class="text-container">
        <div id="title">
            <h2>Stuur mail naar gebruikers</h2>
        </div>

        <div id="users">
            @foreach($users as $user)
                @if($task->customer == $user->customer)
                    <input type="checkbox" id="user_{{$user->id}}" name="assigned_users[]" value="{{$user->id}}">
                    <label for="user_{{$user->id}}">{{$user->name}}</label><br>
                @endif
            @endforeach
        </div>

        <div id="buttons">
            <button onclick="event.preventDefault(); finishTask();">Voltooi</button>
            <button onclick="event.preventDefault(); closeMailPopup();">Doorgaan zonder</button>
        </div>
    </div>
</div>

{{-- Script --}}

<script>
    function finishTask(){
        // get the button the user clicked
        let button = event.target;
        console.log(button);

        // document.getElementById('finish-form').submit();
    }
</script>