@extends('frontend.FrontLayout')

@section('title')
    {{ 'Home Page' }}
@endsection

@section('content')

<div id="page-content">
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Create Account</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row billing-fields">

            @if(Session::has('login_err'))
            <h5 style="color: red;">{{ (Session::get('login_err')) }}</h5>
            @endif

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                <form name="register" method="POST" action="{{ url('customer_register')}}">
                    @csrf
                    <div class="create-ac-content bg-light-gray padding-20px-all">
                        <fieldset>
                            <h2 class="login-title mb-3">Register here</h2>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-firstname">First Name <span class="require">*</span></label>
                                    <input name="customer_firstname" value="{{ old('customer_firstname')}}" type="text">
                                    @error('customer_firstname')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-lastname">Last Name <span class="required-f">*</span></label>
                                    <input name="customer_lastname" value="{{ old('customer_lastname')}}" type="text">
                                    @error('customer_lastname')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-email">E-Mail <span class="required-f">*</span></label>
                                    <input name="customer_email" value="{{ old('customer_email')}}" type="email">
                                    @error('customer_email')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-telephone">Telephone <span class="required-f">*</span></label>
                                    <input name="customer_telephone" value="{{ old('customer_telephone')}}" type="tel">
                                    @error('customer_telephone')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-company">Password</label>
                                    <input name="customer_password" value="{{ old('customer_password')}}" type="password">
                                    @error('customer_password')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-address-1">Confirm <span class="required-f">*</span></label>
                                    <input name="customer_con_password" value="{{ old('customer_con_password')}}" type="password">
                                    @error('customer_con_password')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-address-2">Address <span class="required-f">*</span></label>
                                    <input name="customer_address" value="{{ old('customer_address')}}" type="text">
                                    @error('customer_address')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-pincode">pin Code <span class="required-f">*</span></label>
                                    <input name="customer_pincode" value="{{ old('customer_pincode')}}" type="text">
                                    @error('customer_pincode')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-city">City <span class="required-f">*</span></label>
                                    <input name="customer_city" value="{{ old('customer_city')}}" type="text">
                                    @error('customer_city')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-zone">Region / State <span class="required-f">*</span></label>
                                    <input name="customer_state" value="{{ old('customer_state')}}" type="text">

                                    <!-- <select name="customer_state" id="input-zone">
                                        <option value=""> --- Please Select --- </option>
                                        <option value="3513">Aberdeen</option>
                                        <option value="3514">Aberdeenshire</option>
                                        <option value="3515">Anglesey</option>
                                        <option value="3516">Angus</option>
                                    </select> -->
                                    @error('customer_state')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-country">Country <span class="required-f">*</span></label>
                                    <input name="customer_country" value="{{ old('customer_country')}}" id="input-city" type="text">

                                    <!-- <select name="customer_country" id="input-country">
                                        <option value=""> --- Please Select --- </option>
                                        <option value="244">Aaland Islands</option>
                                        <option value="1">Afghanistan</option>
                                        <option value="2">Albania</option>
                                        <option value="3">Algeria</option>
                                        <option value="4">American Samoa</option>
                                        <option value="5">Andorra</option>
                                        <option value="6">Angola</option>
                                    </select> -->
                                    @error('customer_country')
                                    <span style="color:grey">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <div class="order-button-payment">
                            <button class="btn" value="Place order" type="submit">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection