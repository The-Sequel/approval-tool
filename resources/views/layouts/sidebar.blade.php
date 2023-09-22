<div class="sidebar">
    <img width="200" height="122" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" data-ll-status="loaded">
    <ul>
        <a href="{{route('admin.index')}}"><li>Dashboard</li></a>
        <div class="customerSidebar">
            <a href="{{route('admin.customers.index')}}"><li>Klanten</li></a><button onclick="createCustomer()" style="height: 50%; width: 10%;">+</button>
        </div>
        <a id="create-customer" style="display: none;" href="{{route('admin.customers.create')}}"><li>Klant aanmaken</li></a>
        {{-- The list items under this comment still need to be finished --}}
        <a href="{{route('admin.projects.index')}}"><li>Projecten</li></a>
        <a href="{{route('admin.tasks.index')}}"><li>Taken</li></a>
        <li>Berichten</li>
        <li>Deadlines</li>
    </ul>
</div>