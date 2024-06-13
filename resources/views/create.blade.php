<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('crud.store')}}" method="post">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name">

        <label for="email">email</label>
        <input type="text" name="email">

        <label for="pwd">pwd</label>
        <input type="text" name="pwd">

        <button type="submit" name="submit">submit</button>
        
    </form>

</body>

</html>