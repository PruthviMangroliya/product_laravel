@extends('frontend.FrontLayout')

@section('title')
    {{ 'Home Page' }}
@endsection

@section('content')

<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Login</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                @if(Session::has('login_err'))
                <h5 style="color: red;">{{ (Session::get('login_err')) }}</h5>
                @endif
                <div class="mb-4">
                    <!-- <form method="post" action="#" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">	 -->
                    <form name="login" method="POST" action="{{ url('customer_login')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="login_email">Email</label>
                                    <input type="email" name="login_email" placeholder="" id="login_email" class="" autocorrect="off" autocapitalize="off" autofocus="">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="login_password">Password</label>
                                    <input type="password" value="" name="login_password" placeholder="" id="login_password" class="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="btn mb-3" value="Sign In">
                                <p class="mb-4">
                                    <a href="#" id="RecoverPassword">Forgot your password?</a> &nbsp; | &nbsp;
                                    <a href="{{ url('customer_register')}}" id="customer_register_link">Create account</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection