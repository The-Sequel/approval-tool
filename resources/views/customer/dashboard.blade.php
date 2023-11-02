@extends('layouts.app-master')

@section('content')
<div class="grid" style="margin-left: 270px;">
    <div class="col-4">
        @if($tasksWithDeadlineCount == 0)
            <h2>Taken in brand <span style="color: grey;">(0)</span>🔥</h2>
        @elseif($tasksWithDeadlineCount < 10)
            <h2>Taken in brand <span style="color: grey;">(0{{$tasksWithDeadlineCount}})</span>🔥</h2>
        @else
            <h2>Taken in brand <span style="color: grey;">({{$tasksWithDeadlineCount}})</span>🔥</h2>
        @endif
        @foreach($tasks as $task)
            <div onclick="window.location.href='{{ route('customer.tasks.show', ['task' => $task]) }}';" class="task-card">
                <div class="task-card-head">
                    <p>{{$task->title}}</p>
                </div>
                <div class="task-card-info">
                    <div class="task-card-image">
                        {{-- Get the first image --}}
                        @if($task->images)
                            @if(count(json_decode($task->images, true)) > 0)
                                @php
                                    $imagesArray = json_decode($task->images, true);
                                @endphp

                                @if(is_array($imagesArray) && count($imagesArray) > 0)
                                    <div class="image-gallery">
                                        @php
                                            $firstImage = reset($imagesArray); // Get the first image from the array
                                        @endphp
                                        <a href="{{ asset('storage/' . $firstImage) }}">
                                            <img src="{{ asset('storage/' . $firstImage) }}" style="width: 70%; height: auto; margin-bottom: 10px;">
                                        </a>
                                    </div>
                                @endif
                            @else
                                <img src="{{ asset('storage/'.$task->customer->logo) }}" alt="{{ $task->customer->logo }}" width="50">
                            @endif
                        @else
                            <img src="{{ asset('storage/'.$task->customer->logo) }}" alt="{{ $task->customer->logo }}" width="50">
                        @endif
                    </div>
                    <div class="task-card-body">
                        @if(Str::length($task->description) < 20)
                            <p>{{$task->description}}</p>
                        @else
                            <p>{{ implode(' ', array_slice(explode(' ', $task->description), 0, 4)) }}...</p>
                        @endif
                        <div class="task-card-items">
                            <div class="task-card-data">
                                <p class="task-card-created_at">{{date('d-m-Y', strtotime($task->created_at))}}</p>
                                @if($task->project_id != null)
                                    <p class="task-card-department">{{$task->project->department->title}}</p>
                                @endif
                            </div>
                            <div class="task-card-persons">
                                @foreach($task->customer->users as $user)
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="col-4">
        @if($projectsCount == 0)
            <h2>Lopende projecten <span style="color: grey;">(0)</span>🚀</h2>
        @elseif($projectsCount < 10)
            <h2>Lopende projecten <span style="color: grey;">(0{{$projectsCount}})</span>🚀</h2>
        @else
            <h2>Lopende projecten <span style="color: grey;">({{$projectsCount}})</span>🚀</h2>
        @endif
        @foreach($projects as $project)
            <div onclick="window.location.href='{{ route('customer.projects.show', ['project' => $project]) }}';" class="project-card">
                <div class="project-card-head">
                    <p>{{$project->title}}</p>
                </div>
                <div class="project-card-info">
                    <div class="project-card-image">
                        <img src="{{ asset('storage/'.$project->customer->logo) }}" alt="{{$project->customer->name}}" width="50">
                    </div>
                    <div class="project-card-body">
                        @if(Str::length($project->description) < 20)
                            <p>{{$project->description}}</p>
                        @else
                            <p>{{ implode(' ', array_slice(explode(' ', $project->description), 0, 4)) }}...</p>
                        @endif
                        <p class="project-card-tasks" style="display: none;">Tasks: {{$project->tasks->count()}}</p>
                        <div style="margin-top: 44px;" class="myProgress" id="progress-{{$project->id}}">
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
                                @foreach($project->customer->users as $user)
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        @endforeach
    </div>

    <div class="col-4">
        <div class="dashboard-cards">
            <div class="questions-card">
                <h3>Vragen?</h3>
                <p>Deze nemen wij graag weg</p>
                <form action="{{route('customer.contact', 0)}}" method="GET">
                    @csrf
                    @method('GET')
                    <button>Contact</button>
                </form>
            </div>
            <div class="problem-card">
                <h3>Technische problemen?</h3>
                <p>Dat is natuurlijk niet de bedoeling</p>
                <form action="{{route('customer.contact', 1)}}" method="GET">
                    @csrf
                    @method('GET')
                    <button>Contact</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection