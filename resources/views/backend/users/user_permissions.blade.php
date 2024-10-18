@extends('backend.layout')

@section('title')
    {{ 'User Permissions' }}
@endsection


@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>User Permissions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Permissions</h5>


                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Permissions </th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_permission as $key => $permission)
                                        <tr>
                                            <th>{{ $key + 1 }}</th>
                                            <td>{{ $permission->permission }}</td>
                                            <td>
                                                {{-- <a href="remove_permissions/{{ $permission->id }}"><button
                                                            type="button" class="btn btn-primary" data-toggle="modal">
                                                            Remove permission </button></a> --}}
                                                <div class="col-3 ">
                                                    <input type="hidden" id="permission_id" value="{{ $permission->id }}">
                                                    <input type="hidden" id="user_id" value="{{ $user_id }}">
                                                    
                                                        <select name="permission_status"
                                                            class="form-control permission_status">
                                                            <option value="enable">Enable</option>
                                                            <option value="disable"
                                                                {{ in_array($permission->id, $removed_permissoins) ? 'selected' : '' }}>
                                                                Disable</option>
                                                        </select>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <script>
        $(".permission_status").on('change', function() {

            status = $(this).val();
            permission_id = $(this).closest('div').children('#permission_id').val();
            user_id = $(this).closest('div').children('#user_id').val();

            // console.log(status);
            // console.log(permission_id);
            // console.log(user_id);
            if (status == "disable") {
                $.ajax({
                    url: "{{ url('/remove_permission') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status: status,
                        permission_id: permission_id,
                        user_id: user_id
                    },
                    success: {
                        function() {
alert("permission disabled");
                        }
                    }
                })
            }
        })
    </script>
@endsection
