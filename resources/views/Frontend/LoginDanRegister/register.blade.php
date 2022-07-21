@extends('Frontend.Layouts.master', ['title'=>'Register'])

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
                            <form class="form-stl" action="{{route('TambahUser')}}" name="frm-login" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="singin-email-2">Nama Lengkap</label>
                                    <input type="text" id="frm-reg-lname" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Purnomo Dev">
                                    <span class ="text-danger">@error('name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="singin-password-2">Alamat</label>
                                    <input type="text" id="frm-reg-email" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Jl. Alianyang, Gg. Sawi 2">
                                    <span class ="text-danger">@error('alamat') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="singin-password-2">Provinsi</label>
                                    <select class="form-control provinsi" name="provinsi_id" aria-hidden="true">
                                        <option value="0" required>-- Pilih Provinsi --</option>
                                        @foreach ($provinsi as $provinsis => $value)
                                            <option value="{{ $provinsis  }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>	
                                <div class="form-group">
                                    <label for="singin-password-2">Kota</label>
                                    <select class="form-control kota" name="kota_id" aria-hidden="true">
                                        <option value="" required>-- Pilih Kota --</option>
                                    </select>
                                </div>	
                                <div class="form-group">
                                    <label for="singin-password-2">Nomor Hp</label>
                                    <input type="text" id="frm-reg-email" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror" placeholder="0895704043814">
                                    <span class ="text-danger">@error('nomor_hp') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="singin-password-2">Email</label>
                                    <input type="email" id="frm-reg-email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="contoh@gmail.com">
                                    <span class ="text-danger">@error('email') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="singin-password-2">Password *</label>
                                    <input type="password" id="frm-reg-pass" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                    <span class ="text-danger">@error('password') {{$message}} @enderror</span>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>Register</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
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
