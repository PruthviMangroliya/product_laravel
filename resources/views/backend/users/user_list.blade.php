@extends('backend.layout')

@section('title')
    {{ 'Users' }}
@endsection


@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Users</h1>
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
                            <h5 class="card-title">Users List</h5>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Users Name </th>
                                        <th>User Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach ($roles as $role)
                                                    @if ($role->id == $user->role)
                                                        {{ $role->role }}
                                                        {{-- {{ $user->role }} --}}
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#assign_role_{{ $user->id }}">
                                                    Change Role
                                                </button>
                                            </td>
                                            <td>
                                                @if($user->role !=0)
                                                <a href="user_permissions/{{$user->id}}"><button type="button" class="btn btn-primary" data-toggle="modal">
                                                   View permission </button></a>
                                                @endif
                                            </td>
                                        </tr>
                                        {{-- Modal to change user role --}}
                                        <div class="modal fade" id="assign_role_{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="">Assign Role </h5>
                                                    </div>

                                                    <form action="change_role" method="post">
                                                        <div class="modal-body">
                                                            <div>
                                                                @csrf
                                                                <label for="user_role" class="form-label">Role</label>
                                                                <div class="col-12">
                                                                    <select name="user_role" class="form-control">
                                                                        <option value="">------ Roles -- ---</option>
                                                                        @foreach ($roles as $role)
                                                                            <option value="{{ $role->id }}">
                                                                                {{ $role->role }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <input type="hidden" value="{{ $user->id }}"
                                                                    name="user_id">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Modal to change user role --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
