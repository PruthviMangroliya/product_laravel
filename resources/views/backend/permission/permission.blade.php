@extends('backend.layout')

@section('title')
    {{ 'Permissions' }}
@endsection


@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Permissions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Permissions</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Permissions</h5>
                            <button class="btn btn-primary"><a href="<?php echo url('set_permission'); ?>" style="color:white">
                                Set New Permission</a></button>
                            <br><br>

                            <form method="POST">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Permission ID</th>
                                            <th>Permissions Name </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                               <td>{{$permission->id}}</td>
                                                <td>{{ $permission->permission }}</td>
                                                <td><button class="btn btn-danger"><a href="<?php echo url('delete_role/' . $permission->id); ?>"
                                                            style="color: white;">delete</a></button></td>
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
