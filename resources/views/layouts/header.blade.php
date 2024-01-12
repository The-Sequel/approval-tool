@php
    use App\Models\Customer;
    use App\Models\User;
    use App\Models\Project;
    use App\Models\Task;
    use App\Models\Message;

    // get 3 latest messages and check if the message is within the last 24 hours and if the message is for the current user
    // $messages = Message::where('created_at', '>=', \Carbon\Carbon::now()->subDays(1))->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->take(3)->get();

    // get all of the messages where the json users column contains the current user id
    $messages = Message::whereJsonContains('users', Auth::user()->id)->orderBy('created_at', 'desc')->where('seen', false)->take(3)->get();


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
        'admin/messages/search' => 'Berichten',

        // Filters admin
        'admin/projects/deadline' => 'Projecten',
        'admin/tasks/deadline' => 'Taken',

        // Customer side
        '/' => 'Hi, ' . Auth::user()->name,
        'projects' => 'Projecten',
        'users' => 'Gebruikers',
        'tasks' => 'Taken',
        'messages' => 'Berichten',
        'contact' => 'Contact',
        'search/tasks' => 'Taken',
        'search/projects' => 'Projects',
        'search/messages' => 'Berichten',
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
            <div class="notification">
                <span class="material-symbols-outlined md-48 notification-icon">
                    notifications
                    <?php if (count($messages) > 0) : ?>
                        <svg height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="position: relative; right: 50px;">
                            <circle cx="10" cy="4" r="4" fill="red" />
                        </svg>
                    <?php else : ?>
                        <svg height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="position: relative; right: 50px;">
                            
                        </svg>
                    <?php endif; ?>
                </span>
                <span class="notification-content">
                    <h3>Meldingen</h3>
                    <div class="border"></div>
                    <?php if (count($messages) > 0) : ?>
                        @foreach($messages as $message)
                            <div class="notification-content-data">
                                <div id="header-container">
                                    @if($message->project_id != null)
                                        <h2>{{$message->project->title}}</h2>
                                    @elseif($message->task_id != null)
                                        <h2>{{$message->task->title}}</h2>
                                    @endif

                                    <h4>{{$message->created_at}}</h4>
                                </div>

                                <div id="message">

                                    <div class="user-logo-main">
                                        <div class="user-information">
                                            <p style="background-color: {{$message->user->color}};" class="user-logo">{{substr($message->user->name, 0, 1)}}</p>
                                            <span class="user-information-content">
                                                <div class="user-information-content-logo">
                                                    <p style="background-color: {{$message->user->color}};" class="user-logo">{{substr($message->user->name, 0, 1)}}</p>
                                                </div>
                                                <div class="user-information-content-data">
                                                    <p>{{$message->user->name}}</p>
                                                    <p>{{$message->user->email}}</p>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <p>{{$message->name}}</p>
                                </div>
                            </div>
                        @endforeach
                    <?php else : ?>
                        <div class="no-notifications">
                            Geen meldingen
                        </div>
                    <?php endif; ?>
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
    let messages = [].concat(@json($messages));
</script>