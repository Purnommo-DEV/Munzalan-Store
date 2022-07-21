@extends('Frontend.Layouts.master')

@section('konten')
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Register</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">							
                <div class=" main-content-area">
                    <div class="wrap-login-item ">
                        <div class="register-form form-item ">
                            <form class="form-stl" action="{{route('TambahUser')}}" name="frm-login" method="POST">
                                @csrf
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Create an account</h3>
                                    <h4 class="form-subtitle">Personal infomation</h4>
                                </fieldset>									
                                <fieldset class="wrap-input">
                                    <label for="frm-reg-lname">Name*</label>
                                    <input type="text" id="frm-reg-lname" name="name" class="@error('name') is-invalid @enderror" placeholder="Last name*">
                                    <span class ="text-danger">@error('name') {{$message}} @enderror</span>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-reg-email">Email Address*</label>
                                    <input type="email" id="frm-reg-email" name="email" class="@error('email') is-invalid @enderror" placeholder="Email address">
                                    <span class ="text-danger">@error('email') {{$message}} @enderror</span>
                                </fieldset>
                                {{-- <fieldset class="wrap-functions ">
                                    <label class="remember-field">
                                        <input name="newletter" id="new-letter" value="forever" type="checkbox"><span>Sign Up for Newsletter</span>
                                    </label>
                                </fieldset> --}}
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Login Information</h3>
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half left-item ">
                                    <label for="frm-reg-pass">Password *</label>
                                    <input type="text" id="frm-reg-pass" name="password" class="@error('password') is-invalid @enderror" placeholder="Password">
                                    <span class ="text-danger">@error('password') {{$message}} @enderror</span>
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half ">
                                    <label for="frm-reg-cfpass">Confirm Password *</label>
                                    <input type="text" id="frm-reg-cfpass" name="password" class="@error('password') is-invalid @enderror" placeholder="Confirm Password">
                                    <span class ="text-danger">@error('password') {{$message}} @enderror</span>
                                </fieldset>
                                <input type="submit" class="btn btn-sign" value="Register" name="register">
                            </form>
                        </div>											
                    </div>
                </div><!--end main products area-->		
            </div>
        </div><!--end row-->

    </div><!--end container-->

</main>
@endsection