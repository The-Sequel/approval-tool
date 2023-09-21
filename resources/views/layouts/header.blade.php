@php
    $routeTitles = [
        // Admin side
        'admin' => 'Dashboard',
        'admin/customers' => 'Klanten',
        'admin/customers/create' => 'Klant aanmaken',
        'admin/projects' => 'Projecten',
        'admin/projects/create' => 'Project aanmaken',
        'admin/tasks' => 'Taken',
        'admin/tasks/create' => 'Taak aanmaken'
        // Customer side
    ];
    $route = Request::path();
@endphp
<div class="header">
    @if(isset($routeTitles[$route]))
        <div class="header-1">
            <h1>{{ $routeTitles[$route] }}</h1>
            <p>Laten we samen aan de slag gaan</p>
        </div>
        <div class="header-2">
            <p>tdaf</p>
        </div>
    @endif
</div>


<style>
    .header{
        background-color: #f5f5f5;
        padding: 1rem;
        margin-top: 20px;
        margin-left: 20px;
        margin-right: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        height: 100%;
    }

    .header h1{
        font-size: 2rem;
        font-weight: bold;
    }
</style>