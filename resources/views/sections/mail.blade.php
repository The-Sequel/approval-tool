<div class="mail-popup" id="mail-popup">
    <div class="text-container">
        <span onclick="closeFinishTaskPopup()" class="material-symbols-outlined close-button">
            close
        </span>

        <div id="title">
            <h2>Stuur mail naar gebruikers</h2>
        </div>

        <div id="users">
            @foreach($users as $user)
                @if($user->status == 'active')
                    @if($task->customer == $user->customer)
                        <input type="checkbox" id="user_{{$user->id}}" name="assigned_users[]" value="{{$user->id}}">
                        <label for="user_{{$user->id}}">{{$user->name}}</label><br>
                    @endif
                @endif
            @endforeach
        </div>

        <input type="checkbox" id="select_all" onclick="selectAll()">
        <label for="select_all">Selecteer alle gebruikers</label><br>

        <div id="buttons">
            <button onclick="event.preventDefault(); finishTask();">Verzenden</button>
        </div>
    </div>
</div>

{{-- Script --}}

<script>
    function closeFinishTaskPopup(){
        document.querySelector('.mail-popup .text-container').style.visibility = 'hidden';
    }

    function finishTask(){
        let form = document.getElementById('finish-form');
        let input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', 'send_mail');
        input.setAttribute('value', 'true');
        form.appendChild(input);

        document.getElementById('finish-form').submit();
    }

    function selectAll(){
        let checkboxes = document.querySelectorAll('#users input[type="checkbox"]');
        let selectAll = document.getElementById('select_all');

        if(selectAll.checked){
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
        }else{
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    }

    // document.addEventListener('click', function(event) {
    //     let mailPopup = document.querySelector('.mail-popup .text-container');
        
    //     // Check if the click is outside the popup
    //     if (!mailPopup.contains(event.target)) {
    //         mailPopup.style.visibility = 'hidden';
    //     }
    // });
</script>