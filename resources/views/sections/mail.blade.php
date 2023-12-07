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
            <button onclick="event.preventDefault(); finishTask();">Verzenden</button>
        </div>
    </div>
</div>

{{-- Script --}}

<script>
    function finishTask(){
        let form = document.getElementById('finish-form');
        let input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', 'send_mail');
        input.setAttribute('value', 'true');
        form.appendChild(input);

        document.getElementById('finish-form').submit();
    }

    function openMailPopup(){
        // set visibility to visible of mail popup
        document.querySelector('.mail-popup').style.visibility = 'visible';
    }
</script>