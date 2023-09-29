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
                                <p>{{date('d-m-Y', strtotime($task->created_at))}}</p>
                                <p>{{$task->department->title}}</p>
                            </div>
                            <div class="task-card-persons">
                                @foreach($users as $user)
                                    @if($user->customer_id == $task->customer_id)
                                        <p class="task-card-person">{{Str::ucfirst(substr($user->name, 0, 1))}}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- Align this in the right corner of the project-card --}}
        <a href="/admin/tasks">Bekijk alle taken</a>
    </div>

    <div class="col-4">
        <h1>Lopende projecten <span style="color: grey;">(03)</span></h1>
        @foreach($projects as $project)
            <div class="project-card">
                <div class="project-card-head">
                    <p>{{$project->title}}</p>
                </div>
                <div class="project-card-info">
                    <div class="project-card-image">
                        <img src="{{ asset('storage/'.$project->customer->logo) }}" alt="{{$project->customer->name}}" width="50">
                    </div>
                    <div class="project-card-body">
                        <p>{{$project->description}}</p>
                        <p style="display: none;">Tasks: {{$project->tasks->count()}}</p>
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
                                <p>{{date('d-m-Y', strtotime($project->created_at))}}</p>
                                <p>{{$project->department->title}}</p>
                            </div>
                            <div class="project-card-persons">
                                @foreach($users as $user)
                                    @if($user->customer_id == $project->customer_id)
                                        <p class="project-card-person">{{substr($user->name, 0, 1)}}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        @endforeach

        <a href="/admin/projects">Bekijk alle projecten</a>

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





    {{-- <div class="projects">
        @foreach($projects as $project)

            <div class="project">
                {{$project->title}}
            </div>  

        @endforeach
        <div class="project">
            Test
        </div>  
        <div class="project">
            Test
        </div>  
        <div class="project">
            Test
        </div>  
    </div>

    <style>
        .projects{
            display: flex;
            flex-direction: column;
        }

        .project{
            height: 200px;
            width: 200px;
            background-color: yellow;
        }
    </style> --}}
@endsection()

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head> --}}
{{-- <style>
    *{
        margin: 0;
        padding: 0;
    }

    /* Sidebar */

    .sidebar{
        background-color: #f5f5f5;
        height: 100vh;
        width: 250px;
        padding: 1rem;
    }

    .sidebar ul a{
        list-style: none;
        text-decoration: none;
    }

    .sidebar ul li{
        padding: 1rem;
        cursor: pointer;
    }

    .sidebar ul li:hover{
        background-color: #e6e6e6;
        border-radius: 5px;
    }
    
    .header{
        background-color: #ccc;
        height: 100px;
        padding: 1rem;
    }

    .container{
        display: flex;
    }

    .grid-even-columns {
        display: grid;
        gap: 1rem;
        grid-template-columns: repeat(1, 1fr); /* Change to a single column */
    }

    .grid-even-columns > div {
        background-color: white;
        box-shadow: #ccc 0px 0px 10px;
        height: 150px;
        width: 300px;
        padding: 1rem;
        margin: 1rem;
        display: grid; 
        border-radius: 5px;
        grid-template-columns: repeat(3, 1fr);
    }

    /* .grid-even-columns > div{
        display: grid; 
        border-radius: 5px;
        grid-template-columns: repeat(3, 1fr);
    } */

    .grid-even-columns > div > .grid-item{
        grid-column: 1 / 2; 
        grid-row: 1; 
        background-color:red;
    }

</style> --}}
{{-- <body>
    <header>
        
    </header>
    <main>
        <div class="container">
            <div class="sidebar">
                <img width="200" height="122" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" data-ll-status="loaded">
                <ul>
                    <a href="{{route('admin.index')}}"><li>Dashboard</li></a>
                    <a href="{{route('admin.customers.index')}}"><li>Klanten</li></a> --}}
                    {{-- The list items under this comment still need to be finished --}}
                    {{-- <li>Projecten</li>
                    <li>Taken</li>
                    <li>Berichten</li>
                    <li>Deadlines</li>
                </ul>
            </div>
            <div class="grid-even-columns">
                <h1>Taken in brand <span style="color: grey;">(05)</span></h1> --}}
                {{-- This needs to be put in a foreach loop to show all the tasks --}}
                {{-- <div> --}}
                    {{-- <div class="grid-item">1</div>
                    <div style="grid-column: 2 / 4; grid-row: 1; background-color:blue;">2</div>
                    <div><img width="100" height="100" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" data-ll-status="loaded"></div>
                    <div>4</div>
                    <div>5</div>
                    <div>6</div> --}}
                {{-- </div> --}}
                {{-- This needs to be removed if everything works 'check above code' --}}
                {{-- <div>Klant: <span>Houten Kozijn Online</span></div>
                <div>Klant: <span>Houten Kozijn Online</span></div>
            </div>
            <div class="grid-even-columns">
                <h1>Lopende projecten <span style="color: grey;">(03)</span></h1>
                <div>1</div>
                <div>1</div>
                <div>1</div>
            </div>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html> --}}

{{-- Old dashboard is under here --}}

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot> --}}

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="alert alert-success" id="success-message">{{session('success')}}</div>

                        <script>
                            setTimeout(function() {
                                document.getElementById('success-message').style.display = 'none';
                            }, 5000); // 5000 milliseconds (5 seconds) - adjust as needed
                        </script>
                    @endif --}}
                    {{-- <button>
                        <a href="{{ route('admin.users.create') }}">Add User</a>
                    </button>
                    <button style="margin-left:10px;">
                        <a href="{{ route('admin.customers.create') }}">Add Customer</a>
                    </button>
                    <button style="margin-left:10px;">
                        <a href="{{ route('project.index') }}">Create Project</a>
                    </button>
                    <button style="margin-left:10px;">
                        <a href="{{ route('admin.users.index') }}">Users List</a>
                    </button>
                    <button style="margin-left:10px;">
                        <a href="{{ route('admin.customers.index') }}">Customers List</a>
                    </button>

                    <form action="{{ route('filter.projects') }}" method="GET" id="filter-form">
                        <div class="form-group">
                            <label for="status">Filter op status:</label>
                            <select id="status" name="status" class="form-control">
                                <option value="">Selecteer status</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="approved">Approved</option>
                                <option value="denied">Denied</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prio_level">Filter op prioriteit Level:</label>
                            <select id="prio_level" name="prio_level" class="form-control">
                                <option value="">Selecteer prioriteit level</option>
                                <option value="1">High</option>
                                <option value="2">Medium</option>
                                <option value="3">Low</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user">Filter op gebruiker:</label>
                            <select id="user" name="user" class="form-control">
                                <option value="">Selecteer user</option>
                                @foreach($users as $user)
                                    <option value="{{$user->name}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="customer">Filter by Customer:</label>
                            <select id="customer" name="customer" class="form-control">
                                <option value="">Selecteer customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Filter by Date:</label>
                            <input type="date" id="date" name="date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </form>
                    <form action="{{route('admin.index')}}" method="GET">
                        <button type="submit" class="btn btn-primary">Clear Filters</button>
                    </form>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Project name</th>
                                <th>Project description</th>
                                <th>Gemaakt door</th>
                                <th>Customer name</th>
                                <th>Deadline</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Prio level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{$project->title}}</td>
                                    <td>{{$project->description}}</td>
                                    <td>{{$project->created_by}}</td>
                                    <td>{{$project->customer->name}}</td>
                                    <td>{{$project->deadline}}</td>
                                    <td>
                                        <a href="{{asset('storage' . $project->file)}}" target="_blank">File</a>
                                    </td>
                                    <td>
                                        <form action="{{route('project.update', $project)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status">
                                                @if($project->status == 'pending')
                                                    <option value="pending" selected>Pending</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="approved">Approved</option>
                                                    <option value="denied">Denied</option>
                                                @elseif($project->status == 'completed')
                                                    <option value="pending">Pending</option>
                                                    <option value="completed" selected>Completed</option>
                                                    <option value="approved">Approved</option>
                                                    <option value="denied">Denied</option>
                                                @elseif($project->status == 'approved')
                                                    <option value="pending">Pending</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="approved" selected>Approved</option>
                                                    <option value="denied">Denied</option>
                                                @elseif($project->status == 'denied')
                                                    <option value="pending">Pending</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="approved">Approved</option>
                                                    <option value="denied" selected>Denied</option>
                                                @endif 
                                            </select>
                                            <td>
                                                <select name="prio_level">
                                                    <option value="" selected></option>
                                                    @if($project->prio_level == 3)
                                                        <option value="3" selected>Low</option>
                                                        <option value="2">Medium</option>
                                                        <option value="1">High</option>
                                                    @elseif($project->prio_level == 2)
                                                        <option value="3">Low</option>
                                                        <option value="2" selected>Medium</option>
                                                        <option value="1">High</option>
                                                    @elseif($project->prio_level == 1)
                                                        <option value="3">Low</option>
                                                        <option value="2">Medium</option>
                                                        <option value="1" selected>High</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <input type="submit" value="Update" class="btn btn-success">
                                            </td>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- @foreach($projects as $project)
        <a href="{{route('project.show', $project)}}">
            <div class="container" name="{{$project->id}}">
                <div>
                    {{$project->title}}
                </div>
            </div>
        </a>
    @endforeach --}}
    {{-- <script>
        // Wait for the DOM to load
        document.addEventListener('DOMContentLoaded', function () {
            // Get the filter elements
            const statusFilter = document.getElementById('status');
            const prioLevelFilter = document.getElementById('prio_level');
            const userFilter = document.getElementById('user');
            const customerFilter = document.getElementById('customer');
    
            // Get the selected values from the query parameters
            const params = new URLSearchParams(window.location.search);
            const selectedStatus = params.get('status');
            const selectedPrioLevel = params.get('prio_level');
            const selectedUser = params.get('user');
            const selectedCustomer = params.get('customer');
    
            // Set the selected values in the filter elements
            if (selectedStatus) {
                statusFilter.value = selectedStatus;
            }
            if (selectedPrioLevel) {
                prioLevelFilter.value = selectedPrioLevel;
            }
            if (selectedUser) {
                userFilter.value = selectedUser;
            }
            if (selectedCustomer) {
                customerFilter.value = selectedCustomer;
            }
        });

        // Submit the form here
        // document.querySelector('#filter').addEventListener("change", function() {
        //     this.form.submit();
        // });
    </script> --}}
{{-- </x-app-layout> --}}