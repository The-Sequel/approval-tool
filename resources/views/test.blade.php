{{-- @extends('layouts.base')

@section('content')

<style>
    *{
        margin: 0;
        padding: 0;
    }

    .sidebar{
        background-color: #f5f5f5;
        height: 100vh;
        width: 200px;
        padding: 1rem;
    }
    
    .header{
        background-color: #ccc;
        height: 100px;
        padding: 1rem;
    }

    .container{
        display: flex;
    }

    .grid-even-columns {
        display: grid;
        gap: 1rem;
        grid-template-columns: repeat(1, 1fr); /* Change to a single column */
    }

    .grid-even-columns > div {
        background-color: white;
        box-shadow: #ccc 0px 0px 10px;
        height: 150px;
        width: 300px;
        padding: 1rem;
        margin: 1rem;
        display: grid; 
        border-radius: 5px;
        grid-template-columns: repeat(3, 1fr);
    }

    /* .grid-even-columns > div{
        display: grid; 
        border-radius: 5px;
        grid-template-columns: repeat(3, 1fr);
    } */

    .grid-even-columns > div > .grid-item{
        grid-column: 1 / 2; 
        grid-row: 1; 
        background-color:red;
    }

</style>

<div class="grid-even-columns">
    <h1>Taken in brand <span style="color: grey;">(05)</span></h1>
    <div>Klant: <span>Houten Kozijn Online</span>
        <p class="image">Image here</p>    
    </div>
    <div>Klant: <span>Houten Kozijn Online</span></div>
    <div>Klant: <span>Houten Kozijn Online</span></div>
</div>
<div class="grid-even-columns">
    <h1>Lopende projecten <span style="color: grey;">(03)</span></h1>
    <div>1</div>
    <div>1</div>
    <div>1</div>
</div>

<style>
    .angry-grid {
       display: grid; 
    
       grid-template-rows: 1fr 1fr 1fr 1fr;
       grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
       
       gap: 0px;
       height: 100%;
       
    }
      
    #item-0 {
    
       background-color: #C7D767; 
       grid-row-start: 1;
       grid-column-start: 1;
    
       grid-row-end: 2;
       grid-column-end: 4;
       
    }
    #item-1 {
    
       background-color: #EBD8AF; 
       grid-row-start: 1;
       grid-column-start: 5;
    
       grid-row-end: 2;
       grid-column-end: 6;
       
    }
    #item-2 {
    
       background-color: #8F9AD7; 
       grid-row-start: 3;
       grid-column-start: 1;
    
       grid-row-end: 5;
       grid-column-end: 3;
       
    }
    #item-3 {
    
       background-color: #9BFFAF; 
       grid-row-start: 2;
       grid-column-start: 4;
    
       grid-row-end: 3;
       grid-column-end: 6;
       
    }
    #item-4 {
    
       background-color: #76C65F; 
       grid-row-start: 3;
       grid-column-start: 4;
    
       grid-row-end: 4;
       grid-column-end: 6;
       
    }
    </style>
    
    <div class="angry-grid">
      <div id="item-0">&nbsp;</div>
      <div id="item-1">&nbsp;</div>
      <div id="item-2">&nbsp;</div>
      <div id="item-3">&nbsp;</div>
      <div id="item-4">&nbsp;</div>
    </div>

@endsection --}}


@extends('layouts.app-master')

@section('content')

@endsection