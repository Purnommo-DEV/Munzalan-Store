@extends('Frontend.Layouts.master', ['title'=>'Login'])

@section('konten')
<main id="main" class="main-site left-sidebar">


    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url({{asset('gambar/bg_loginRegister/bg.jpg')}})">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Selamat Datang di MunzalanStore</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                            <form action="{{route('cekLogin')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="singin-email-2">Email</label>
                                    <input type="text" id="frm-login-uname" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Cth: maspur@gmail.com">
                                    <span class ="text-danger">@error('email') {{$message}} @enderror</span>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="singin-password-2">Password *</label>
                                    <input type="password" id="frm-login-pass" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="************">
                                    <span class ="text-danger">@error('password') {{$message}} @enderror</span>
                                                                </div><!-- End .form-group -->

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>Masuk</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    {{-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signin-remember-2">
                                        <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                                    </div><!-- End .custom-checkbox -->

                                    <a href="#" class="forgot-link">Forgot Your Password?</a> --}}
                                </div><!-- End .form-footer -->
                            </form>
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->

</main>
@endsection