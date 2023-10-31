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
            {{-- <div class="customerSidebar">
                <a href="{{route('admin.customers.index')}}"><li>Klanten</li></a><button onclick="createCustomer()" style="height: 50%; width: 10%;">+</button>
                <a id="create-customer" style="display: none;" href="{{route('admin.customers.create')}}"><li>Klant aanmaken</li></a>
            </div> --}}
            {{-- The list items under this comment still need to be finished --}}
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    table_chart
                    </span>
                {{-- <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg> --}}
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
                {{-- <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg> --}}
                <a href="{{route('admin.messages.index')}}"><li>Berichten</li></a>
            </div>
            <div class="sidebar-item">
                <span class="material-symbols-outlined">
                    person
                </span>
                {{-- <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> --}}
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
                {{-- <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><li>Uitloggen</li></a>
                <span class="material-icons logout">
                    lock
                    </span> --}}
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
                <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><li>Uitloggen</li></a>
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