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

<div id="mobile-menu">

    <div id="mobile-content">
        <ul>
            @if(Auth::user()->role->name == 'admin')
                <li>
                    <div id="item">
                        <span class="material-icons">
                            pie_chart
                        </span>
                        <a href="{{route('admin.index')}}">Dashboard</a>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-symbols-outlined">
                            bookmark
                        </span>
                        <a href="{{route('admin.customers.index')}}">Klanten</a>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-symbols-outlined">
                            table_chart
                        </span>
                        <a href="{{route('admin.projects.index')}}">Projecten</a>
                        <p id="projectCount">{{$projectsCount}}</p>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-symbols-outlined">
                            task_alt
                        </span>
                        <a href="{{route('admin.tasks.index')}}">Taken</a>
                        <p id="taskCount">{{$tasksCount}}</p>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-symbols-outlined">
                            mail
                        </span>
                        <a href="{{route('admin.messages.index')}}">Berichten</a>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-symbols-outlined">
                            person
                        </span>
                        <a href="{{route('admin.users.index')}}">Gebruikers</a>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-icons logout">
                            lock
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="logout">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Uitloggen</a>
                            </div>
                        </form>
                    </div>
                </li>
                @elseif(Auth::user()->role->name == 'customer')
                <li>
                    <div id="item">
                        <span class="material-icons">
                            pie_chart
                        </span>
                        <a href="{{route('customer.dashboard')}}">Dashboard</a>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-symbols-outlined">
                            table_chart
                            </span>
                        <a href="{{route('customer.projects.index')}}">Projecten</a>
                        <p id="projectCount">{{$projectsCountCustomer}}</p>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-symbols-outlined">
                            task_alt
                            </span>
                        <a href="{{route('customer.tasks.index')}}">Taken</a>
                        <p id="taskCount">{{$tasksCountCustomer}}</p>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-symbols-outlined">
                            mail
                        </span>
                        <a href="{{route('customer.messages.index')}}">Berichten</a>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-symbols-outlined">
                            person
                        </span>
                        <a href="{{route('customer.users.index')}}">Gebruikers</a>
                    </div>
                </li>

                <li>
                    <div id="item">
                        <span class="material-symbols-outlined">
                            contact_mail
                            </span>
                        <a href="{{route('customer.contact', 0)}}">Contact</a>
                    </div>
                </li>
                <li>
                    <div id="item">
                        <span class="material-icons logout">
                            lock
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="logout">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Uitloggen</a>
                            </div>
                        </form>
                    </div>
                </li>
            @endif
        </ul>
    </div>
    
    <div id="mobile-bar">
        <div class="sidebar-toggle" id="mobile-menu-button">
            <svg id="openIcon" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
            <svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 352 512">
                <path d="M242.7 256l100.1-100.1c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L197.4 210.7 97.3 110.6c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l100.1 100.1L52 355.9c-12.5 12.5-12.5 32.8 0 45.3 12.5 12.5 32.8 12.5 45.3 0l100.1-100.1 100.1 100.1c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L242.7 256z"/>
            </svg>
        </div>
    </div>
</div>