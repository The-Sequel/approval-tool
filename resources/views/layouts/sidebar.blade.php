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

<style>
    .sidebar{
        background-color: #f5f5f5;
        height: 100vh;
        width: 250px;
        padding: 1rem;
        resize: none;
        float: left;
    }

    .sidebar ul a{
        list-style: none;
        text-decoration: none;
        font-family: Arial, Helvetica, sans-serif;
        color: black;
    }

    .sidebar ul li{
        padding: 1rem;
        cursor: pointer;
        /* These 2 under this comment can be removed when all of the other <a> elements are fixed */
        list-style: none;
        font-family: Arial, Helvetica, sans-serif; 
    }

    .sidebar ul li:hover{
        background-color: #e6e6e6;
        border-radius: 5px;
    }

    .customerSidebar{
        display: flex;
    }

    .customerSidebar button {
        height: 100%;
        width: 10%;
        border-radius: 5px;
        border: none;
        background-color: #e6e6e6;
        cursor: pointer;
    }
</style>

<script>
    function createCustomer(){
        var createCustomer = document.getElementById('create-customer');
        if (createCustomer.style.display === 'block') {
            createCustomer.style.display = 'none';
        } else {
            createCustomer.style.display = 'block';
        }
    }

    function createCustomerCard(){
        var createCustomerCard = document.getElementById('create-customer-card');
        if (createCustomerCard.style.display === 'block') {
            createCustomerCard.style.display = 'none';
        } else {
            createCustomerCard.style.display = 'block';
        }
    }

</script>