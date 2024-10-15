@extends('backend.layout')

@section('title')
    {{ 'roles' }}
@endsection


@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Roles</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Roles</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Roles List</h5>
                            <button class="btn btn-primary"><a href="<?php echo url('set_role'); ?>" style="color:white">
                                    Set New Role</a></button>
                            <br><br>

                            <form method="POST">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Role ID</th>
                                            <th>Roles Name </th>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->role }}</td>
                                                <td>{{ $role->permission }}</td>
                                                <td>
                                                    <button class="btn btn-danger"><a href="<?php echo url('delete_role/' . $role->id); ?>"
                                                            style="color: white;">delete</a></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
