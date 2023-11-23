@php
    use App\Models\Project;
    use App\Models\Task;

    if(Auth::user()->role_id == 1) {
        $projectsCount = Project::where('status', '!=', 'completed')->count();
        $tasksCount = Task::where('status', '!=', 'approved')->count();
    } else

    if(Auth::user()->role_id == 2) {
        $projectsCountCustomer = Project::where('customer_id', Auth::user()->customer->id)->where('status', '!=', 'completed')->count();
        $tasksCountCustomer = Task::where('customer_id', Auth::user()->customer_id)->where('status', '!=', 'approved')->count();
    }
@endphp

<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

<div class="sidebar-toggle" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
</div>

<div id="sidebar" class="sidebar">
    <div class="sidebar-toggle" onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
    </div>
    <div class="sidebar-logo">
        <a href="https://www.thesequel.nl" target="_blank"><img width="200" height="122" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" data-ll-status="loaded"></a>
    </div>
    <ul>
        @if(Auth::user()->role->name == 'admin')
            <div class="sidebar-item">
                <span class="material-icons">
                    pie_chart
                </span>
                <a href="{{route('admin.index')}}"><li>Dashboard</li></a>
            </div>
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    bookmark
                    </span>
                <a href="{{route('admin.customers.index')}}"><li>Klanten</li>
            </div>

            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    table_chart
                    </span>
                <a href="{{route('admin.projects.index')}}"><li>Projecten</li></a>
                <p class="amount">{{$projectsCount}}</p>
            </div>
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    task_alt
                    </span>
                <a href="{{route('admin.tasks.index')}}"><li>Taken</li></a>
                <p style="margin-left: 49px;" class="amount">{{$tasksCount}}</p>
            </div>
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    mail
                </span>
                <a href="{{route('admin.messages.index')}}"><li>Berichten</li></a>
            </div>
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    person
                </span>
                <a href="{{route('admin.users.index')}}"><li>Gebruikers</li></a>
            </div>
            {{-- logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="logout">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><li>Uitloggen</li></a>
                    <span class="material-icons logout">
                        lock
                        </span>
                </div>
            </form>

        @elseif(Auth::user()->role->name == 'customer')
            <div class="sidebar-item" class="sidebar-item">
                <span class="material-icons">
                    pie_chart
                </span>
                <a href="{{route('customer.dashboard')}}"><li>Dashboard</li></a>
            </div>
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    table_chart
                    </span>
                <a href="{{route('customer.projects.index')}}"><li>Projecten</li></a>
                <p class="amount">{{$projectsCountCustomer}}</p>
            </div>
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    task_alt
                    </span>
                <a href="{{route('customer.tasks.index')}}"><li>Taken</li></a>
                <p style="margin-left: 49px;" class="amount">{{$tasksCountCustomer}}</p>
            </div>
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    mail
                </span>
                <a href="{{route('customer.messages.index')}}"><li>Berichten</li></a>
            </div>
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    person
                </span>
                <a href="{{route('customer.users.index')}}"><li>Gebruikers</li></a>
            </div>
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    contact_mail
                    </span>
                <a href="{{route('customer.contact', 0)}}"><li>Contact</li></a>
            </div>
            {{-- logout --}}
            <img style="margin-bottom: 50px; margin-left: 20px;" class="logout" src="{{ asset('storage/'.Auth::user()->customer->logo) }}" width="50px">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="logout">
                    <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><li>Uitloggen</li></a>
                    <span class="material-icons logout">
                        lock
                        </span>
                </div>
            </form>
        @endif
    </ul>
</div>


<script>
    function toggleSidebar(){
        const sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle('active');
    }
</script>
