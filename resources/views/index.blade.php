    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <a href="{{ route('crud.create')}}" class="btn btn-primary"> Add </a>
            <table>
                <thead>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                </thead>

                <tbody>
                    @foreach ($users as $user )
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <th><a href="{{ route('crud.show',$user->id)}}">View</a></th>
                        <th><a href="{{ route('crud.edit',$user->id)}}">Edit</a></th>
                        <th><form action="{{ route('crud.destroy',$user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="">Delete</button>
                            </form>
                        </th>

                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="mt-5" style="size:2px">

                {{ $users->links()}}
            </div>
        </div>
        
    </body>

    </html>