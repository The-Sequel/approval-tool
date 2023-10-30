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

<div class="sidebar">
    <div class="sidebar-logo">
        <a href="https://www.thesequel.nl" target="_blank"><img width="200" height="122" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" data-ll-status="loaded"></a>
    </div>
    <ul>
        @if(Auth::user()->role->name == 'admin')
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm64 64V416H224V160H64zm384 0H288V416H448V160z"/></svg>
                <a href="{{route('admin.index')}}"><li>Dashboard</li></a>
            </div>
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M392 32H56C25.1 32 0 57.1 0 88v336c0 30.9 25.1 56 56 56h336c30.9 0 56-25.1 56-56V88c0-30.9-25.1-56-56-56zm-108.3 82.1c0-19.8 29.9-19.8 29.9 0v199.5c0 19.8-29.9 19.8-29.9 0V114.1zm-74.6-7.5c0-19.8 29.9-19.8 29.9 0v216.5c0 19.8-29.9 19.8-29.9 0V106.6zm-74.7 7.5c0-19.8 29.9-19.8 29.9 0v199.5c0 19.8-29.9 19.8-29.9 0V114.1zM59.7 144c0-19.8 29.9-19.8 29.9 0v134.3c0 19.8-29.9 19.8-29.9 0V144zm323.4 227.8c-72.8 63-241.7 65.4-318.1 0-15-12.8 4.4-35.5 19.4-22.7 65.9 55.3 216.1 53.9 279.3 0 14.9-12.9 34.3 9.8 19.4 22.7zm5.2-93.5c0 19.8-29.9 19.8-29.9 0V144c0-19.8 29.9-19.8 29.9 0v134.3z"/></svg>
                <a href="{{route('admin.customers.index')}}"><li>Klanten</li>
            </div>
            {{-- <div class="customerSidebar">
                <a href="{{route('admin.customers.index')}}"><li>Klanten</li></a><button onclick="createCustomer()" style="height: 50%; width: 10%;">+</button>
                <a id="create-customer" style="display: none;" href="{{route('admin.customers.create')}}"><li>Klant aanmaken</li></a>
            </div> --}}
            {{-- The list items under this comment still need to be finished --}}
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg>
                <a href="{{route('admin.projects.index')}}"><li>Projecten</li></a>
                <p class="amount">{{$projectsCount}}</p>
            </div>
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"/></svg>
                <a href="{{route('admin.tasks.index')}}"><li>Taken</li></a>
                <p style="margin-left: 49px;" class="amount">{{$tasksCount}}</p>
            </div>
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                <a href="{{route('admin.messages.index')}}"><li>Berichten</li></a>
            </div>
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                <a href="{{route('admin.users.index')}}"><li>Gebruikers</li></a>
            </div>
            {{-- logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><li>Uitloggen</li></a>
            </form>
        @elseif(Auth::user()->role->name == 'customer')
            <div class="sidebar-item" class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm64 64V416H224V160H64zm384 0H288V416H448V160z"/></svg>
                <a href="{{route('customer.dashboard')}}"><li>Dashboard</li></a>
            </div>
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg>
                <a href="{{route('customer.projects.index')}}"><li>Projecten</li></a>
                <p class="amount">{{$projectsCountCustomer}}</p>
            </div>
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"/></svg>
                <a href="{{route('customer.tasks.index')}}"><li>Taken</li></a>
                <p style="margin-left: 49px;" class="amount">{{$tasksCountCustomer}}</p>
            </div>
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                <a href="{{route('customer.messages.index')}}"><li>Berichten</li></a>
            </div>
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                <a href="{{route('customer.users.index')}}"><li>Gebruikers</li></a>
            </div>
            <div class="sidebar-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M96 0C60.7 0 32 28.7 32 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H96zM208 288h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H144c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V80zM496 192c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V336z"/></svg>
                <a href="{{route('customer.contact')}}"><li>Contact</li></a>
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