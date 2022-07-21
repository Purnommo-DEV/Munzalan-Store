@extends('Frontend.Layouts.master')

@section('konten')
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>login</span></li>
            </ul>
        </div>

        <div class="main-content-area">
            @if(Session::has('success_message'))
            <div class="alert alert-success" role="alert" style="margin-top: 10px;">
                {{Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(Session::has('error_message'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form action="{{ route('periksaBelanjaan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Alamat Pengiriman</h3>
                    <div class="wrap-login-item ">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                            Tambah Alamat
                        </button>
                        <div class="item-content">
                            <div class="wrap-contact-detail">
                                <table class="table">

                                    @foreach ($tampil_alamat as $alamat)
                                    <tr>
                                        <td>
                                            <input type="radio" id="alamat{{ $alamat->id }}" name="alamat_id"
                                            value="{{ $alamat->id }}">
                                            {{ $alamat->name }}, {{ $alamat->alamat }}, {{ $alamat->kota->name }}, 
                                            {{ $alamat->provinsi->name }}, {{ $alamat->negara }},
                                            {{ $alamat->kode_pos }}
                                        </td>
                                        <td>
                                            <button type="button" value="{{ $alamat->id }}"
                                                class="btn btn-primary ubahBtn">Ubah</button>
                                            <a href="#" class="btn btn-danger btn-sm hapusAlamat"
                                                alamat-id="{{$alamat->id}}">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="wrap-iten-in-cart">
                        <h3 class="box-title"> </h3>
                        <div class="item-content">
                        </div>
                    </div>

                    <div class="wrap-iten-in-cart">
                        <h3 class="box-title">Products Name</h3>
                        <ul class="products-cart">
                            <?php $total = 0; $sub_total = 0; $total_berat = 0;?>
                            @foreach($penggunaKeranjangItem as $item)
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    @foreach ($gambar_produk as $gambar_produks)
                                        @if ($item['produk']['id'] == $gambar_produks['gambar_produk']['produk_id'])
                                            <figure>
                                                <img src="{{ asset('frontend/assets/images/products/'.$gambar_produks['gambar_produk']['gambar1']) }}" alt="">
                                            </figure>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product" href="#">{{$item['produk']['name']}}<br>Ukuran :
                                        {{$item['ukuran']}}</a>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">@currency($item['harga'])</p>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{$item['kuantitas']}}</p>
                                </div>
                                <?php 
                                    $total = $item['harga'] * $item['kuantitas']; 
                                    $sub_total = $sub_total + ($item['harga'] * $item['kuantitas']);
                                    $total_berat += $item->berat * $item->kuantitas	
                                ?>
                                <div class="price-field sub-total">
                                    <p class="price">@currency($total)</p>
                                </div>
                            </li>
                                @endforeach
                        </ul>
                    </div>

                    <div class="summary">
                        <div class="order-summary">
                            <h4 class="title-box">Ringkasan Pesanan</h4>
                            <p class="summary-info"><span class="title">Subtotal</span><b
                                    class="index">@currency($sub_total)</b></p>
                            <p class="summary-info"><span class="title">Shipping</span><b class="index">Free
                                    Shipping</b></p>
                            <p class="summary-info total-info "><span class="title">Total</span><b
                                    class="index">@currency($sub_total)</b></p>
                            <?php Session::put('total_keseluruhan', $sub_total); ?>


                        </div>
                        <div class="order-summary">
                            <h5 class="title-box"></h5>
                        </div>
                        <div class="checkout-info">
                            <h5 class="title-box"><b>METODE PEMBAYARAN</b></h5>
                            <div>
                                {{-- <input type="radio" id="COD" name="metode_pembayaran" value="COD"><label>&nbsp;COD</label>&nbsp;&nbsp;&nbsp; --}}
                                <input class="cek" type="checkbox" id="TF" name="metode_pembayaran"
                                    value="TF"><label>&nbsp;Transfer Bank</label>
                            </div>
                            <div class="summary summary-checkout" id="tampil" hidden>
                                <div class="summary-item payment-method">
                                    <h4 class="title-box">Payment Method</h4>
                                    <div class="wrap-iten-in-cart">
                                        <ul class="products-cart" style="border-top: none;">
                                            <li class="pr-cart-item">
                                                <div class="product-image">
                                                    <figure><img
                                                            src="{{ asset('frontend/assets/images/products/'.$item['produk']['gambar']) }}"
                                                            alt="" style="max-width: 100px;"></figure>
                                                </div>
                                                <div class="product-name">
                                                    <a class="link-to-product" href="#">Bank Central Asia<br>2208 1233<br>Munzalan Store</a>
                                            </li>
                                            <li class="pr-cart-item">
                                                <div class="product-image">
                                                    <figure><img
                                                            src="{{ asset('frontend/assets/images/products/'.$item['produk']['gambar']) }}"
                                                            alt="" style="max-width: 100px;"></figure>
                                                </div>
                                                <div class="product-name">
                                                    <a class="link-to-product" href="#">Bank Central Asia<br>2208 1233<br>Munzalan Store</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="summary-item shipping-method">
                                    <h4 class="title-box f-title">Shipping method</h4>
                                    <p class="row-in-form">
                                        <label for="coupon-code">Asal Bank</label>
                                        <input type="text" name="asal_bank" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="coupon-code">Nama Pengirim</label>
                                        <input type="text" name="nama_pengirim" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="coupon-code">Nomor Rekening</label>
                                        <input type="text" name="nomor_rekening" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="coupon-code">Upload Bukti Transfer</label>
                                        <input type="file" name="bukti_bayar" required>
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" name="total_berat" value="{{$total_berat}}">
                            <button type="submit" class="btn btn-checkout">Periksa</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</main>

@foreach ($tampil_alamat as $alamat)
<div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="ubahModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">ubah Alamat</h4>
            </div>
            <div class="modal-body">
                <div class=" main-content-area">
                    <div class="wrap-address-billing">
                        <form action="{{ route('perbaruiAlamat',$alamat->id) }}" method="post" name="frm-billing">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $alamat->id }}" hidden>
                            <div>
                                <p class="row-in-form">
                                    <label for="fname">Nama Lengkap<span>*</span></label>
                                    <input type="text" name="name" id="name" required>
                                </p>
                                <p class="row-in-form">
                                    <label for="email">Negara:</label>
                                    <input type="text" name="negara" id="negara" required>
                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Provinsi<span>*</span></label>
                                    <input type="text" name="provinsi" id="provinsi" required>
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Kota</label>
                                    <input type="text" name="kota" id="kota" required>
                                </p>
                                <p class="row-in-form">
                                    <label for="country">Kode Pos<span>*</span></label>
                                    <input type="number" name="kode_pos" id="kode_pos" min="0" required>
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Email</label>
                                    <input id="email" type="email" name="email" required>
                                </p>
                                <p class="row-in-form">
                                    <label for="zip-code">Nomor Hp</label>
                                    <input type="number" name="nomor_hp" id="nomor_hp" min="0" required>
                                </p>
                            </div>
                            <div>
                                <p class="row-in-form">
                                    <label for="lname">Alamat<span>*</span></label>
                                    <textarea name="alamat" id="alamat" cols="60" rows="8"
                                        style="border-radius: none !important;" required></textarea>
                                </p>
                            </div>
                            <div class="summary">
                                <div class="checkout-info">
                                    <label class="checkbox-field">
                                    </label>
                                    <button type="submit" class="btn btn-checkout">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Alamat</h4>
            </div>
            <div class="modal-body">
                <div class=" main-content-area">
                    <div class="wrap-address-billing">
                        <form action="{{ route('tambahAlamat') }}" method="post" name="frm-billing">
                            @csrf
                            <div>
                                <p class="row-in-form">
                                    <label for="fname">Nama Lengkap<span>*</span></label>
                                    <input id="fname" type="text" name="name" required>
                                </p>
                                <p class="row-in-form">
                                    <label for="email">Negara:</label>
                                    <input id="email" type="text" name="negara" required>
                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Provinsi<span>*</span></label>
                                    <select class="form-control provinsi-asal" style="display: block !important;" name="provinsi_id">
                                        <option value="0">-- Pilih provinsi asal --</option>
                                        @foreach ($provinsi as $provinsis => $value)
                                            <option value="{{ $provinsis  }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Kota</label>
                                    <select class="form-control kota-asal" name="kota_id">
                                        <option value="">-- Pilih kota asal --</option>
                                    </select>
                                </p>
                                <p class="row-in-form">
                                    <label for="country">Kode Pos<span>*</span></label>
                                    <input id="country" type="number" name="kode_pos" min="0" required>
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Email</label>
                                    <input id="add" type="email" name="email" required>
                                </p>
                                <p class="row-in-form">
                                    <label for="zip-code">Nomor Hp</label>
                                    <input id="zip-code" type="number" name="nomor_hp" min="0" required>
                                </p>
                            </div>
                            <div>
                                <p class="row-in-form">
                                    <label for="lname">Alamat<span>*</span></label>
                                    <textarea id="comment" name="alamat" cols="60" rows="8"
                                        style="border-radius: none !important;" required></textarea>
                                </p>
                            </div>
                            <div class="summary">
                                <div class="checkout-info">
                                    <label class="checkbox-field">
                                    </label>
                                    <button type="submit" class="btn btn-checkout">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    //Jika ada class yang bernama delete lalu di klik maka jalankan function() dan tampilkan alert(1) atau pesan
    $('.hapusAlamat').click(function () {
        //Buat variabel baru siswa_id, This mengacu pada clas yang di klik yaitu .delete kemudia ambil attributnya yaitu siswa_id
        var alamat_id = $(this).attr('alamat-id');
        swal({
                title: "Yakin ?",
                text: "Menghapus Data ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/hapusAlamat/" + alamat_id;
                }
            });
    });

    $('select[name="provinsi_id"]').on('change', function () {
        let provindeId = $(this).val();
        if (provindeId) {
            jQuery.ajax({
                url: '/kota/'+provindeId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('select[name="kota_id"]').empty();
                    $('select[name="kota_id"]').append('<option value="">-- Pilih kota asal --</option>');
                    $.each(response, function (key, value) {
                        $('select[name="kota_id"]').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
            });
        } else {
            $('select[name="kota_id"]').append('<option value="">-- Pilih kota asal --</option>');
        }
    });

</script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.ubahBtn', function () {
            var data_id = $(this).val();
            $('#ubahModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/ubahAlamat/" + data_id,
                success: function (response) {
                    //console.log(response.data.status);
                    $('#id').val(data_id);
                    $('#name').val(response.data.name);
                    $('#email').val(response.data.email);
                    $('#negara').val(response.data.negara);
                    $('#provinsi').val(response.data.provinsi);
                    $('#kota').val(response.data.kota);
                    $('#kode_pos').val(response.data.kode_pos);
                    $('#nomor_hp').val(response.data.nomor_hp);
                    $('#alamat').val(response.data.alamat);
                }
            });
        });
    });

</script>
<script>
    $('.cek').change(function () {
        if ($(this).is(':checked')) {
            $('#tampil').show();
        } else {
            $('#tampil').hide();
        }
    });

</script>
@endsection
