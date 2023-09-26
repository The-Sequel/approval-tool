@php
    $routeTitles = [
        // Admin side
        'admin' => 'Dashboard',
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
    ];
    $route = Request::path();
    
    // use customer model
    use App\Models\Customer;
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