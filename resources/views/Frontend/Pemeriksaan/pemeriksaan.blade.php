@extends('Frontend.Layouts.master', ['title'=>'Pemeriksaan'])

@section('konten')

<div class="cart">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Kuantitas</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $total = 0; $sub_total = 0; $total_berat = 0; @endphp
                        @foreach($penggunaKeranjangItem as $item)
                        <tr>
                            <td class="product-col">
                                <div class="product" style="background-color: transparent">
                                    @foreach ($gambar_produk as $gambar_produks)
                                    @if ($item['produk']['id'] == $gambar_produks->produk_id)
                                        <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambar_produks->gambar1 }}" 
                                        width="60" height="15" alt="Gambar Produk">
                                    @endif
                                    @endforeach
                                    <h3 class="product-title" style="font-size: 1.3rem;">
                                        &nbsp;<a href="#">{{$item['produk']['name']}}<br>Ukuran : {{$item['ukuran']}}</a>
                                    </h3>
                                </div>
                            </td>
                            <td class="price-col" style="font-size: 1.3rem;">@currency($item['harga'])</td>
                            <td class="quantity-col">
                                <div class="cart-product-quantity">
                                    {{$item['kuantitas']}}
                                </div>

                            </td>
                            @php
                            $total = $item['harga'] * $item['kuantitas'];
                            $sub_total = $sub_total + ($item['harga'] * $item['kuantitas']);
                            $total_berat += $item->berat * $item->kuantitas
                            @endphp
                            <td class="total-col" style="font-size: 1.3rem;">@currency($total)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    <div class="page-content formTransfer">
                        <div class="checkout">
                            <div class="container">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <h2 class="checkout-title">Upload Bukti Pembayaran</h2>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Bank 1</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Bank 2</label>
                                                </div>
                                            </div>
                                            <form action="{{ route('periksaBelanjaan') }}" method="post"
                                                enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Asal Bank</label>
                                                        <input type="text" class="form-control" name="asal_bank" required>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Nama Pengirim</label>
                                                        <input type="text" class="form-control" name="nama_pengirim"
                                                            required>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Nomor Rekening</label>
                                                        <input type="text" class="form-control" name="nomor_rekening"
                                                            required>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Upload Bukti Transfer</label>
                                                        <input type="file" name="bukti_bayar" required>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
            </div>
            <aside class="col-lg-3">
                <div class="summary summary-cart">
                    <h3 class="summary-title">Ringkasan Belanja</h3>
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
                    @csrf
                    <table class="table table-summary">
                        <tbody>
                            <tr class="summary-subtotal" style="font-size: 1.3rem;">
                                <td>Total:</td>
                                <td style="width: 9rem;"><span id="tampilTotal">@currency($sub_total)</span></td>
                            </tr>
                            <tr class="summary-shipping">
                                <td>Alamat Pengiriman:</td>
                                <td>&nbsp;</td>
                            </tr>
                            @foreach ($tampil_alamat as $alamat)
                            <tr>
                                <td>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="alamat" name="alamat_id" value="{{ $alamat->id }}"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="alamat">
                                            {{ $alamat->name }}, {{ $alamat->alamat }}, {{ $alamat->kota->name }},
                                            {{ $alamat->provinsi->name }}, {{ $alamat->negara }},
                                            {{ $alamat->kode_pos }}
                                        </label>
                                    </div><!-- End .custom-control -->
                                </td>
                                <td></td>
                            </tr><!-- End .summary-shipping-row -->
                            @endforeach
                            <tr class="summary-shipping">
                                <td>Metode Pengiriman:</td>
                                <td>&nbsp;</td>
                            </tr>
                            @foreach ($cek_ongkir as $result)
                            <tr>
                                <td>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="jasaKirim{{ $result['service'] }}"
                                            value="{{ $result['cost'][0]['value'] }}" name="ongkos_kirim"
                                            class="custom-control-input" required>

                                        <label class="custom-control-label" for="jasaKirim{{ $result['service'] }}">
                                            {{ $result['service'] }} - @currency($result['cost'][0]['value']) -
                                            {{ $result['cost'][0]['etd'] }} Hari
                                        </label>
                                    </div><!-- End .custom-control -->
                                </td>
                                <td></td>
                            </tr><!-- End .summary-shipping-row -->
                            @endforeach
                            <tr class="summary-shipping">
                                <td>Metode Pembayaran :</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="custom-control custom-radio">
                                        <input type="checkbox" id="metode_pembayaran" name="metode_pembayaran"
                                            value="TF" class="custom-control-input transferBank">
                                        <label class="custom-control-label" for="metode_pembayaran">
                                            Transfer Bank
                                        </label>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="total_berat" value="{{ $total_berat }}">
                    <input type="hidden" id="totalBayar" name="total_bayar" value="">
                    <input type="hidden" id="jasaPengiriman" name="pengiriman" value="">
                    <button type="submit" class="btn btn-primary btn-block mb-3"><span>Lanjut Pembayaran</span><i
                            class="icon-refresh"></i></button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
</div>

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
                                    <select class="form-control provinsi-asal" style="display: block !important;"
                                        name="provinsi_id">
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
    $(document).on('change', 'input[type=radio][name=ongkos_kirim]', function (event) {

        ongkir = $(this).attr('value');
        pengiriman = $(this).attr('id');

        var subtotal = "{{ $sub_total }}"
        var total = parseInt(ongkir) + parseInt(subtotal);
        $('#totalBayar').attr("value", total);
        $('#jasaPengiriman').attr("value", pengiriman);

        var reverse = total.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        total_dalam_rupiah = ribuan.join('.').split('').reverse().join('');
        $('#tampilTotal').text('Rp ' + total_dalam_rupiah);

    });
</script>
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
                url: '/kota/' + provindeId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('select[name="kota_id"]').empty();
                    $('select[name="kota_id"]').append(
                        '<option value="">-- Pilih kota asal --</option>');
                    $.each(response, function (key, value) {
                        $('select[name="kota_id"]').append('<option value="' + key + '">' +
                            value + '</option>');
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
<script type="text/javascript">
$(function() {
    $(".formTransfer").hide();
    $("#metode_pembayaran").on("click",function() {
    $(".formTransfer").toggle(this.checked);
  });
});
</script>
@endsection
