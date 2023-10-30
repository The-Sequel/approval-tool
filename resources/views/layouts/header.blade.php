@php
    use App\Models\Customer;
    use App\Models\User;
    use App\Models\Project;
    use App\Models\Task;
    use App\Models\Message;

    // get 3 latest messages and check if the message is within the last 24 hours and if the message is for the current user
    $messages = Message::where('created_at', '>=', \Carbon\Carbon::now()->subDays(1))->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->take(3)->get();


    $routeTitles = [
        // Admin side
        'admin' => 'Hi, ' . Auth::user()->name,
        'admin/customers' => 'Klanten',
        'admin/customers/create' => 'Klant aanmaken',
        'admin/search/customers' => 'Klanten',
        'admin/projects' => 'Projecten',
        'admin/projects/create' => 'Project aanmaken',
        'admin/search/projects' => 'Projecten',
        'admin/tasks' => 'Taken',
        'admin/tasks/create' => 'Taak aanmaken',
        'admin/search/tasks' => 'Taken',
        'admin/users' => 'Gebruikers',
        'admin/users/create' => 'Gebruiker aanmaken',
        'admin/search/users' => 'Gebruikers',
        'admin/messages' => 'Berichten',
        // Customer side
        '/' => 'Hi, ' . Auth::user()->name,
        'projects' => 'Projecten',
        'users' => 'Gebruikers',
        'tasks' => 'Taken',
        'messages' => 'Berichten',
        'contact' => 'Contact',
        'search/tasks' => 'Taken',
        'search/projects' => 'Projects',
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

    foreach(Task::all() as $task){
        $routeTitles['admin/tasks/edit/' . $task->id] = 'Taak: ' . $task->title;
    }

    foreach(Project::all() as $project){
        $routeTitles['admin/projects/edit/' . $project->id] = 'Project: ' . $project->title;
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

    // foreach 0 to 3
    for ($i = 0; $i < 4; $i++) {
        $routeTitles['contact/' . $i] = 'Contact';
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
            <p class="header-p">Laten we samen aan de slag gaan</p>
        </div>
        <div class="header-2">
            <div class="notification" onclick="toogleNotificationContent(this)">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <!-- Original notification icon path -->
                    <path
                      d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"
                    />
                  
                    <!-- Red dot at the right upper corner -->
                    <circle cx="420" cy="100" r="100" fill="red" />
                </svg>
                <span class="notification-content">
                    <div class="notification-content-data">
                        <p>Deze functie is nog niet beschikbaar</p>
                        {{-- @dd($messages) --}}
                        {{-- @if($messages != null)
                            @foreach($messages as $message)
                                @if($user->role_id == 2)
                                    @if($message->task_id != null)
                                        <p><a class="notification-item" href="{{route('customer.tasks.show', $message->task_id)}}">{{ date('d F Y', strtotime($message->created_at))}}: {{$message->name}}</a></p>
                                    @elseif($message->project_id)
                                        <p><a class="notification-item" href="{{route('customer.projects.show', $message->project_id)}}">{{ date('d F Y', strtotime($message->created_at))}}: {{$message->name}}</a></p>
                                    @endif
                                @else
                                    
                                @endif
                            @endforeach
                        @else
                            <p>Geen nieuwe berichten</p>
                        @endif --}}
                    </div>
                </span>
            </div>
            <p style="background-color: {{ Auth::user()->color }};" class="user-image">{{$firstLetter}}</p>
            <div class="header-3">
                <p>{{ Auth::user()->name }}</p>
                <p class="header-customer-name">{{ $customer }}</p>
            </div>
            <div class="header-4">
                
            </div>
        </div>
    @endif
</div>
  
  
  

<script>
    function toggleNotificationContent(notification) {
        notification.classList.toggle('open');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const notifications = document.querySelectorAll('.notification');

        // Toggle notification content on click
        notifications.forEach(notification => {
            notification.addEventListener('click', () => {
                toggleNotificationContent(notification);
            });
        });

        // Close notification content when clicking outside
        document.addEventListener('click', (event) => {
            const target = event.target;

            for (const notification of notifications) {
                if (!notification.contains(target)) {
                    notification.classList.remove('open');
                }
            }
        });
    });
</script>