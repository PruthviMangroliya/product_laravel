<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @foreach ($users as $user )
    @endforeach
    <form action="{{ route('crud.update',$user->id)}}" method="post">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" value="{{ $user->name }}" name="name">

        <label for="email">email</label>
        <input type="text" value="{{ $user->email }}" name="email">

        <label for="pwd">pwd</label>
        <input type="text" value="{{ $user->name }}" name="pwd">
        
        <button type="submit" name="submit">submit</button>
    </form>

</body>

</html>