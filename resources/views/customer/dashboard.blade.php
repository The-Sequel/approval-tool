@extends('layouts.app-master')

@section('content')
<div class="grid">
    <div class="col-4">
        <h1>Taken in brand <span style="color: grey;">(05)</span>🔥</h1>
        @foreach($tasks as $task)
            <div class="task-card">
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
                        <p>Klant: {{$task->customer->name}}</p>
                        <p>{{$task->description}}</p>
                        <div class="task-card-items">
                            <div class="task-card-data">
                                <p class="task-card-created_at">{{date('d-m-Y', strtotime($task->created_at))}}</p>
                                <p class="task-card-department">{{$task->department->title}}</p>
                            </div>
                            <div class="task-card-persons">
                                @foreach($task->customer->users as $user)
                                    <p class="task-card-person">{{Str::ucfirst(substr($user->name, 0, 1))}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="col-4">
        <h1>Lopende projecten <span style="color: grey;">(03)</span></h1>
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
                        <p class="project-card-description">{{$project->description}}</p>
                        <p class="project-card-tasks" style="display: none;">Tasks: {{$project->tasks->count()}}</p>
                        <div class="myProgress" id="progress-{{$project->id}}">
                            <div class="myBar"></div>
                        </div>
                        <script>
                            projects = {!! json_encode($projects) !!};

                            projects.forEach(project => {
                                const totalTasks = project.tasks ? project.tasks.length : 0;
                                const completedTasks = project.tasks ? project.tasks.filter(task => task.status === 'completed').length : 0;

                                const progressBar = document.querySelector(`#progress-${project.id} .myBar`);
                                if (progressBar) {
                                    const percentage = totalTasks > 0 ? (completedTasks / totalTasks) * 100 : 0;
                                    progressBar.style.width = percentage + '%';
                                }
                            });
                        </script>
                        <div class="project-card-items">
                            <div class="project-card-data">
                                <p class="project-card-create_at">{{date('d-m-Y', strtotime($project->created_at))}}</p>
                                <p class="project-card-department">{{$project->department->title}}</p>
                            </div>
                            <div class="project-card-persons">
                                @foreach($project->customer->users as $user)
                                    <p class="project-card-person">{{Str::ucfirst(substr($user->name, 0, 1))}}</p>
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
                <form action="{{route('customer.contact')}}" method="GET">
                    @csrf
                    @method('GET')
                    <button>Contact</button>
                </form>
            </div>
            <div class="problem-card">
                <h3>Technische problemen?</h3>
                <p>Dat is natuurlijk niet de bedoeling</p>
                <form action="{{route('customer.contact')}}" method="GET">
                    @csrf
                    @method('GET')
                    <button>Contact</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection