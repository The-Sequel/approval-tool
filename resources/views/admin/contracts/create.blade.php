<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('admin.contracts.store')}}" method="POST">
        @csrf
        @method('POST')
        <label for="name">Name</label>
        <input type="text" name="name" id="name">

        <label for="hours">Hours</label>
        <input type="number" name="hours" id="hours">

        <input type="text" name="customer_id" id="customer_id" value="{{$customer_id}}" hidden>

        <button type="submit">Submit</button>
    </form>
</body>
</html>