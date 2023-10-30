@extends('layouts.app-master')

@section('content')
<div class="flex" style="margin-left: 270px;">
    <div class="col-4">
        <h2>Taken in brand <span style="color: grey;">(05)</span>🔥</h2>
        {{-- <h2>Taken in brand <span style="color: grey;">(05)</span></h2> --}}
        @foreach($tasks as $task)
            <div class="task-card" onclick="window.location.href='{{ route('admin.tasks.show', ['task' => $task]) }}';">
                <div class="task-card-head">
                    <p>{{$task->title}}</p>
                </div>
                <div class="task-card-info">
                    <div class="task-card-image">
                        @if($task->image != null)
                            <img src="{{ asset('storage/'.$task->image) }}" alt="{{$task->image}}" width="50">
                        @else
                            <img src="{{ asset('storage/'.$task->customer->logo) }}" alt="{{$task->customer->logo}}" width="50">
                        @endif
                    </div>
                    <div class="task-card-body">
                        <p class="task-card-customer">Klant: {{$task->customer->name}}</p>
                        @if(Str::length($task->description) < 20)
                            <p>{{$task->description}}</p>
                        @else
                            <p>{{ implode(' ', array_slice(explode(' ', $task->description), 0, 4)) }}...</p>
                        @endif

                        <div class="task-card-items" style="margin-top: 25px;">
                            <div class="task-card-data">
                                <p class="task-card-created_at">{{date('d-m-Y', strtotime($task->created_at))}}</p>
                                @if($task->project_id != null)
                                    <p class="task-card-department">{{$task->project->department->title}}</p>
                                @endif
                            </div>
                            <div class="task-card-persons">
                                @foreach($users as $user)
                                    @if($user->customer_id == $task->customer_id)
                                        <div class="user-information">
                                            <p class="task-card-person">{{substr($user->name, 0, 1)}}</p>
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
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <a class="all-tasks-button" href="/admin/tasks">Bekijk alle taken</a>
    </div>

    <div class="col-4">
        <h2 >Lopende projecten <span style="color: grey;">(03)</span>🚀</h2>
        @foreach($projects as $project)
            <div onclick="window.location.href='{{ route('admin.projects.show', ['project' => $project]) }}';" class="project-card">
                <div class="project-card-head">
                    <p>{{$project->title}}</p>
                </div>
                <div class="project-card-info">
                    <div class="project-card-image">
                        <img src="{{ asset('storage/'.$project->customer->logo) }}" alt="{{$project->customer->name}}" width="50">
                    </div>
                    <div class="project-card-body">
                        <p class="project-card-customer">Klant: {{$project->customer->name}}</p>
                        @if(Str::length($project->description) < 20)
                            <p>{{$project->description}}</p>
                        @else
                            <p>{{ implode(' ', array_slice(explode(' ', $project->description), 0, 4)) }}...</p>
                        @endif
                        <p class="project-card-tasks" style="display: none;">Tasks: {{$project->tasks->count()}}</p>
                        <div style="margin-top: 10px;" class="myProgress" id="progress-{{$project->id}}">
                            <div class="myBar"></div>
                        </div>
                        <script>
                            projects = {!! json_encode($projects) !!};

                            projects.forEach(project => {
                                const totalTasks = project.tasks ? project.tasks.length : 0;
                                const completedTasks = project.tasks ? project.tasks.filter(task => task.status === 'approved').length : 0;

                                const progressBar = document.querySelector(`#progress-${project.id} .myBar`);
                                if (progressBar) {
                                    const percentage = totalTasks > 0 ? (completedTasks / totalTasks) * 100 : 0;
                                    progressBar.style.width = percentage + '%';
                                }
                            });
                        </script>
                        <div class="project-card-items">
                            <div class="project-card-data">
                                <p class="project-card-created_at">{{date('d-m-Y', strtotime($project->created_at))}}</p>
                                <p class="project-card-department">{{$project->department->title}}</p>
                            </div>
                            <div class="project-card-persons">
                                @foreach($users as $user)
                                    @if($user->customer_id == $project->customer_id)
                                        <div class="user-information">
                                            <p class="project-card-person">{{substr($user->name, 0, 1)}}</p>
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
                        </div>
                    </div>
                </div>
               
            </div>
        @endforeach
        <a class="all-projects-button" href="/admin/projects">Bekijk alle projecten</a>

    </div>
    <div class="col-4">
        <div class="dashboard-cards">
            <div class="create-customer-card">
                <h3>Nieuwe klant aanmaken</h3>
                <p>Laten we dit meteen regelen</p>
                <form action="{{route('admin.customers.create')}}" method="GET">
                    @csrf
                    @method('GET')
                    <button>Klant aanmaken</button>
                </form>
            </div>
            <div class="create-user-card">
                <h3>Nieuwe gebruiker aanmaken</h3>
                <p>Laten we dit meteen regelen</p>
                <form action="{{route('admin.users.create')}}" method="GET">
                    @csrf
                    @method('GET')
                    <button>Nieuwe gebruiker aanmaken</button>
                </form>
            </div>
            <div class="active-users-card">
                <h1>{{$users->count()}}</h1>
                <p>Actieve gebruikers</p>
            </div>
        </div>
    </div>
</div>

@if(count($tasksWithDeadline) != 0)
    <div style="" class="popup">
        <span class="popuptext" id="myPopup">
            <div onclick="closePopup()">
                <svg style="position: relative; left: 150px;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
            </div>
            <svg style="margin-bottom: 10px;font-size: 80px; border-style: solid; width: 80px; border-radius: 50%;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 64 512"><path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/></svg>
            <h2 style="margin-bottom: 20px;">Deadline vandaag</h2>
            @foreach($tasksWithDeadline as $task)
                <p style="margin-bottom: 12px;">
                    <a style="text-decoration: none; color: black;" href="{{route('admin.tasks.show', $task)}}">{{$task->title}}</a>
                </p>
            @endforeach
            {{-- @foreach($tasks as $task)
                @if($task->deadline == date('Y-m-d'))
                    <p style="margin-bottom: 12px;">
                        <a style="text-decoration: none; color: black;" href="{{route('admin.tasks.show', $task)}}">{{$task->title}}</a>
                    </p>
                @endif
            @endforeach --}}
            <p style="margin-top: 30px; color: gray;">{{now()->format('D M Y')}}</p>
        </span>
    </div>
@endif

<script>

    // var currentDate = "Thu Nov 1 2023";

    // if(localStorage.getItem('test') === null) {
    //     console.log('popup wordt hier nu getoond');
    //     localStorage.setItem('test', currentDate);
    // } else {
    //     var storedDate = localStorage.getItem('test');

    //     if(storedDate !== currentDate) {
    //         console.log('popup wordt hier nu getoond omdat the gestorde data anders is.')
    //         localStorage.setItem('test', currentDate);
    //     } else {
    //         console.log('popup is al getoond');
    //     }
    // }


    function myFunction() {
        // var popup = document.getElementById("myPopup");
        // popup.classList.toggle("show");
        var currentDate = new Date().toDateString();

        if(localStorage.getItem('popupShownDate') === null) {
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
            localStorage.setItem('popupShownDate', currentDate);
            console.log('popup wordt hier nu getoond');
        } else {
            var storedDate = localStorage.getItem('popupShownDate');

            if(storedDate !== currentDate) {
                var popup = document.getElementById("myPopup");
                popup.classList.toggle("show");
                localStorage.setItem('popupShownDate', currentDate);
                console.log('popup wordt hier nu getoond omdat the gestorde data anders is.')
            } else {
                console.log('popup is al getoond');
            }
        }
    }

    function closePopup(){
        var popup = document.getElementById("myPopup");
        popup.classList.remove("show");
        document.body.classList.remove("popup-open");
    }

    document.body.addEventListener("click", function(event) {
        var popup = document.getElementById("myPopup");
        var popupContainer = document.querySelector(".popup");

        if (!popupContainer.contains(event.target) && event.target !== popupContainer) {
            popup.classList.remove("show");
            document.body.classList.remove("popup-open");

        }
    });

    window.onload = function() {
        myFunction();
    };
</script>


@endsection()
