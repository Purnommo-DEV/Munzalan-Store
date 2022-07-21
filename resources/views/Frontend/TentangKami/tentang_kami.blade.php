@extends('Frontend.Layouts.master', ['title'=>'Tentang Kami'])

@section('konten')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('HalamanBeranda') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('FrontTentangKami') }}">Tentang Kami</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="about-text text-center mt-3">
                        <p>{!! $tentang_kami->teks !!}</p>
                        <img src="{{ asset('gambar/gambar_tentang_kami') }}/{{ $tentang_kami->gambar }}" alt="image" class="mx-auto mb-6">
                    </div><!-- End .about-text -->
                </div><!-- End .col-lg-10 offset-1 -->
            </div><!-- End .row -->
            {{-- <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                        <span class="icon-box-icon">
                            <i class="icon-puzzle-piece"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Design Quality</h3><!-- End .icon-box-title -->
                            <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero <br>eu augue.</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->

                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                        <span class="icon-box-icon">
                            <i class="icon-life-ring"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Professional Support</h3><!-- End .icon-box-title -->
                            <p>Praesent dapibus, neque id cursus faucibus, <br>tortor neque egestas augue, eu vulputate <br>magna eros eu erat. </p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->

                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                        <span class="icon-box-icon">
                            <i class="icon-heart-o"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Made With Love</h3><!-- End .icon-box-title -->
                            <p>Pellentesque a diam sit amet mi ullamcorper <br>vehicula. Nullam quis massa sit amet <br>nibh viverra malesuada.</p> 
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->
            </div><!-- End .row --> --}}
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection