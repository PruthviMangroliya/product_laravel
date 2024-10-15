@extends('backend.layout')

@section('title')
    {{ 'Set Role' }}
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Role</li>
                    <li class="breadcrumb-item active">Add Role and permission</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Set Role</h5>

                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                
                                @csrf
                                <div class="col-12">
                                    <label for="role" class="form-label">New Role</label>
                                    <input type="text" name="role" class="form-control"
                                        value="{{ old('role') }}">
                                    @error('role')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div> 
                                
                                <div class="col-6">
                                    <select name="permissions[]" id="permission" class="form-control" multiple>
                                        <option value="">Select Permission</option>
                                        <?php foreach ($permissions as $permission) { ?>
                                        <option value="<?php echo $permission->id; ?>"><?php echo $permission->permission; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form> 
                            {{-- Pruthvi@pm --}}
                        </div>
                        {{-- mangroliya --}}
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
        $("#permission").select2({
            tags: true,
            placeholder: '-----Select attribute---------'
        })
        </script>
@endsection
