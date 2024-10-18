@extends('backend.layout')

@section('title')
    {{ 'Set Permission' }}
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Permissions</li>
                    <li class="breadcrumb-item active">Set permission</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Set permission</h5>


                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                
                                @csrf
                               
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="permission" class="form-label">Permission</label>
                                            <input type="text" name="permission" class="form-control">
                                            @error('discount_type')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror   
                                        </div>                                        
                                    </div>
                                </div>                            

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>


    <script>
        $("#appy_on").select2({
            tags: true,
            language: "es",
            placeholder: '------ select product for coupon ------'
        })
    </script>
@endsection
