<div class="sidebar">
    <img width="200" height="122" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" data-ll-status="loaded">
    <ul>
        @if(Auth::user()->role->name == 'admin')
            <a href="{{route('admin.index')}}"><li>Dashboard</li></a>
            <div class="customerSidebar">
                <a href="{{route('admin.customers.index')}}"><li>Klanten</li></a><button onclick="createCustomer()" style="height: 50%; width: 10%;">+</button>
                <a id="create-customer" style="display: none;" href="{{route('admin.customers.create')}}"><li>Klant aanmaken</li></a>
            </div>
            {{-- The list items under this comment still need to be finished --}}
            <a href="{{route('admin.projects.index')}}"><li>Projecten</li></a>
            <a href="{{route('admin.tasks.index')}}"><li>Taken</li></a>
            <a href="{{route('admin.messages.index')}}"><li>Berichten</li></a>
            <a href="{{route('admin.users.index')}}"><li>Gebruikers</li></a>
            {{-- logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><li>Uitloggen</li></a>
            </form>
        @elseif(Auth::user()->role->name == 'customer')
            <a href="{{route('customer.dashboard')}}"><li>Dashboard</li></a>
            <a href="{{route('customer.projects.index')}}"><li>Projecten</li></a>
            <a href="{{route('customer.tasks.index')}}"><li>Taken</li></a>
            <a href="{{route('customer.messages.index')}}"><li>Berichten</li></a>
            <a href="{{route('customer.users.index')}}"><li>Gebruikers</li></a>
            <a href="{{route('customer.contact')}}"><li>Contact</li></a>
            {{-- logout --}}
            <img style="margin-bottom: 50px; margin-left: 20px;" class="logout" src="{{ asset('storage/'.Auth::user()->customer->logo) }}" width="50px">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><li>Uitloggen</li></a>
            </form>
        @endif
    </ul>
</div>