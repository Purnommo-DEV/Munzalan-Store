@extends('Admin.Layouts.master')
@section('content')
<div class="content">
    <div class="page-inner">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab-icon" data-toggle="pill" href="#pills-info-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
                                <i class="flaticon-interface-6"></i>
                                Info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-stokUkuran-icon" role="tab" aria-controls="pills-stokUkuran-icon" aria-selected="false">
                                <i class="flaticon-list"></i>
                                Atribut
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab-icon" data-toggle="pill" href="#pills-gambar-icon" role="tab" aria-controls="pills-gambar-icon" aria-selected="false">
                                <i class="flaticon-picture"></i>
                                Gambar
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                        @include('Admin.Produk.deskripsi.info_produk')
                        @include('Admin.Produk.deskripsi.stok_ukuran')
                        @include('Admin.Produk.deskripsi.gambar_produk')
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('footer')
    <script>
    //Jika ada class yang bernama delete lalu di klik maka jalankan function() dan tampilkan alert(1) atau pesan
    $('.hapusUkuran').click(function(){
        //Buat variabel baru siswa_id, This mengacu pada clas yang di klik yaitu .delete kemudia ambil attributnya yaitu siswa_id
        var ukuran_id = $(this).attr('ukuran-id');
        swal({
        title: "Yakin ?",
        text: "Menghapus Data ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = "/hapusUkuranProduk/"+ukuran_id;
                }
            });
        });
    </script>
@endsection