<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approval Tool</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <form action="{{route('admin.customers.store')}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Naam</label>
            <input class="form-control" type="text" name="name" id="name">
        </div>

        <div class="form-group">
            <label for="name">Status</label>
            <select class="form-control" name="status">
                <option></option>
                <option value="active">Active</option>
                <option value="inactive">Non-actief</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Logo</label>
            <input class="form-control" type="text" name="logo" id="logo">
        </div>

        <div class="form-group">
            <label for="name">Debiteur nummer</label>
            <input class="form-control" type="text" name="debtor_number" id="debtor_number">
        </div>
            

        <div class="form-group">
            <input type="submit" value="Create" class="btn btn-primary">
        </div>
    </form>
</body>
</html>