@php
    use App\Models\Customer;
    use App\Models\User;
    use App\Models\Project;
    use App\Models\Task;


    $routeTitles = [
        // Admin side
        'admin' => 'Hi, ' . Auth::user()->name,
        'admin/customers' => 'Klanten',
        'admin/customers/create' => 'Klant aanmaken',
        'admin/projects' => 'Projecten',
        'admin/projects/create' => 'Project aanmaken',
        'admin/tasks' => 'Taken',
        'admin/tasks/create' => 'Taak aanmaken',
        'admin/users' => 'Gebruikers',
        'admin/users/create' => 'Gebruiker aanmaken',
        'admin/messages' => 'Berichten',
        // Customer side
        '/' => 'Hi, ' . Auth::user()->name,
        'projects' => 'Projecten',
        'users' => 'Gebruikers',
        'tasks' => 'Taken',
        'messages' => 'Berichten',
        'contact' => 'Contact',
    ];

    foreach (User::all() as $user) {
        $routeTitles['admin/users/' . $user->id . '/edit'] = 'Gebruiker bewerken: ' . $user->name;
    }

    foreach (Customer::all() as $customer) {
        $routeTitles['admin/customers/' . $customer->id . '/edit'] = 'Klant bewerken: ' . $customer->name;
    }

    foreach(Project::all() as $project) {
        $routeTitles['admin/projects/show/' . $project->id] = 'Project: ' . $project->title;
    }

    foreach(Project::all() as $project) {
        $routeTitles['admin/tasks/create/' . $project->id] = 'Taak aanmaken voor project: ' . $project->title;
    }

    foreach(Task::all() as $task) {
        $routeTitles['admin/tasks/show/' . $task->id] = 'Taak: ' . $task->title;
    }

    foreach(Project::all() as $project) {
        $routeTitles['projects/show/' . $project->id] = 'Project: ' . $project->title;
    }

    foreach(Task::all() as $task){
        $routeTitles['tasks/show/' . $task->id] = 'Taak: ' . $task->title;
    }

    foreach(Task::all() as $task){
        $routeTitles['tasks/approve/' . $task->id] = 'Taak goedkeuren: ' . $task->title;
    }

    $route = Request::path();
    
    // use customer model
@endphp

@php
    $user = Auth::user();
    $firstLetter = substr($user->name, 0, 1);

    if(Customer::find(Auth::user()->customer_id) != null){
        $customer = Customer::find(Auth::user()->customer_id);
        $customer = $customer->name;
    } else {
        $customer = 'Admin';
    }
@endphp

<div class="header">
    @if(isset($routeTitles[$route]))
        <div class="header-1">
            <h1>{{ $routeTitles[$route] }}</h1>
            <p>Laten we samen aan de slag gaan</p>
        </div>
        <div class="header-2">
            <p class="user-image">{{$firstLetter}}</p>
            <div class="header-3">
                <p>{{ Auth::user()->name }}</p>
                <p class="header-customer-name">{{ $customer }}</p>
            </div>
            <div class="header-4">
                
            </div>
        </div>
    @endif
</div>

{{-- <div class="header">
    @if(isset($routeTitles[$route]))
        <div class="header-1">
            <h1>{{ $routeTitles[$route] }}</h1>
            <p>Laten we samen aan de slag gaan</p>
        </div>
        <div class="header-2">
            <p class="user-image">{{$firstLetter}}</p>
        </div>
        <div class="header-3">
            <p>{{ Auth::user()->name }}</p>
            <p>{{ $customer->name }}</p>
        </div>
        <div class="header-4">
            
        </div>
    @endif
</div> --}}