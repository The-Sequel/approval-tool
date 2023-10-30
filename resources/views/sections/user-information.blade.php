<div class="user-logo-main">
    @foreach($users as $user)
        @if(in_array($user->id, json_decode($task->assigned_to)))
            <div class="user-information">
                <p style="background-color: {{$user->color}};" class="user-logo">{{substr($user->name, 0, 1)}}</p>
                <span class="user-information-content">
                    <div class="user-information-content-logo">
                        <p style="background-color: {{$user->color}};" class="user-logo">{{substr($user->name, 0, 1)}}</p>
                    </div>
                    <div class="user-information-content-data">
                        <p>{{$user->name}}</p>
                        <p>{{$user->email}}</p>
                    </div>
                </span>
            </div>
        @endif
    @endforeach
</div>