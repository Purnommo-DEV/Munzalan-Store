@extends('Admin.Layouts.master')
@section('content')
<div class="content">
    <div class="page-inner">

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card" style="padding-bottom: 1rem;">
                                    <div class="card-header" style="padding: 0.1rem 1.0rem;">
                                        <h4 class="card-title">Daftar Produk</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="data_produk_admin" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama Produk</th>
                                                    <th>Harga Produk</th>
                                                    <th>Diskon</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_produk as $data_produks)
                                                <tr>
                                                    <td>{{$data_produks->name}}</td>
                                                    <td>@currency($data_produks->harga)</td>
                                                    <td>{{ $data_produks->diskon }}%</td>

                                                    <td>
                                                <button type="submit" class="btn btn-primary btn-block btn-xs" data-toggle="modal"
                                                        data-target="#pilihProduk-{{ $data_produks->id }}"><b>Pilih</b></button>
                                                    <form action="{{ route('AdminMasukkanKeranjang') }}" method="POST">
                                                        @csrf
                                                        <div class="modal fade" id="pilihProduk-{{ $data_produks->id }}" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <table class="table table-striped table-bordered text-center">
                                                                            <input type="hidden" name="harga" value="{{ $data_produks->harga }}" hidden>
                                                                            <input type="hidden" name="produk_id" value="{{ $data_produks->id }}" hidden>
                                                                            <tr>
                                                                                <td><strong>Nama Produk</strong></td>
                                                                                <td colspan="4">{{ $data_produks->name }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Harga Produk</strong></td>
                                                                                <td colspan="4">
                                                                                    @php
                                                                                        $harga_diskon = App\Models\Produk::tampilDiskon($data_produks['id']);
                                                                                    @endphp
                                                                                    @if($harga_diskon>0)
                                                                                        <label class="placeholder"><del>@currency($data_produks->harga)</del></label>
                                                                                    @else
                                                                                        <ins><label class="text-success">@currency($data_produks->harga)</label></ins>
                                                                                    @endif
                                                                                    @if($harga_diskon>0)
                                                                                        <ins><label class="text-success">@currency($harga_diskon)</label></ins>
                                                                                    @endif
                                                                                    
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Diskon %</strong></td>
                                                                                <td colspan="4">{{ $data_produks->diskon }}%</td>
                                                                            </tr>
                                                                            @foreach ($data_produk_atribut as $data_produk_atributs)
                                                                                @if($data_produk_atributs->produk_id == $data_produks->id)
                                                                                    <tr>
                                                                                        <td><strong>Ukuran</strong></td>
                                                                                        <td>{{ $data_produk_atributs->ukuran }}</td>
                                                                                        <td><strong>Stok</strong></td>
                                                                                        <td>{{ $data_produk_atributs->stok }}</td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                            <tr>
                                                                                <td><strong>Masukkan Ukuran</strong></td>
                                                                                <td colspan="4">
                                                                                    <div class="form-group">
                                                                                        <div class="selectgroup w-100">

                                                                                            <select class="form-control provinsi-asal" style="display: block !important;" name="ukuran" required>
                                                                                                <option value="" required>-- Pilih Ukuran --</option>
                                                                                                @foreach ($data_produk_atribut as $data_produk_atributs )
                                                                                                @if($data_produk_atributs->produk_id == $data_produks->id)
                                                                                                    @if ($data_produk_atributs->id == $data_produk_atributs->id && $data_produk_atributs->stok > 0 )
                                                                                                        <option value="{{ $data_produk_atributs->ukuran  }}">{{ $data_produk_atributs->ukuran }}</option>
                                                                                                    @endif
                                                                                                @endif
                                                                                                @endforeach
                                                                                            </select>

                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Masukkan Kuantitas</strong></td>
                                                                                <td colspan="4">
                                                                                    <div class="product-details-quantity">
                                                                                        <input type="number" name="kuantitas" id="stok" class="form-control" value="1" min="1" max="" step="1" data-decimals="0" required>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="card card-round">
                                    <div class="card-body">
                                        <div class="card-header" style="padding: 0.1rem 1.0rem;">
                                            <h4 class="card-title">Keranjang</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="alamat_pengiriman" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Produk</th>
                                                        <th>Harga Produk</th>
                                                        <th>Harga</th>
                                                        <th>Kuantitas</th>
                                                        <th>Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $sub_total = 0; $total_bayar = 0;?>
                                                    @foreach ($data_keranjang as $data_keranjangs)
                                                    @php
                                                        $sub_total = $data_keranjangs->harga * $data_keranjangs->kuantitas;
                                                        $total_bayar = $total_bayar + ($data_keranjangs->harga * $data_keranjangs->kuantitas);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $data_keranjangs->produk->name }}</td>
                                                        <td>{{ $data_keranjangs->harga }}</td>
                                                        <td>@currency($data_keranjangs->harga)</td>
                                                        <td>{{ $data_keranjangs->kuantitas }}</td>
                                                        <td>@currency($sub_total)</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tr>
                                                    <td></td><td></td>
                                                    <td colspan="2"><strong>Total</strong>
                                                    <td>@currency($total_bayar)</td>
                                                </tr>
                                            </table>
                                                <form action="{{ route('AdminBuatPesanan') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="total_bayar" value="{{ $total_bayar }}">
                                                    <div class="card-footer" style="padding: 0rem 1.0rem;">
                                                        <button type="submit" class="btn btn-primary btn-block"><b>Setujui Pesanan</b></button>
                                                    </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-title fw-mediumbold">Total Belanja</div>
                        <div class="table-responsive">
                            <table id="alamat_pengiriman" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Total Belanja</th>
                                        <th>Metode Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $final_bayar = 0; ?>
                                    @foreach($data_pesanan as $data_pesanans)
                                    <tr>
                                        <td>@currency($data_pesanans->total_bayar)</td>
                                        <td>{{ $data_pesanans->metode_pembayaran }}</td>
                                    </tr>
                                    @php
                                        $final_bayar += $data_pesanans->total_bayar;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer" style="padding: 0rem 1.0rem;">
                                <button class="btn btn-info btn-block"><b>Total : @currency( $final_bayar )</b></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-12">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="card-title fw-mediumbold">Produk Dipesan</div>
                            <div class="card-list">
                                @foreach ($data_produk_pesanan as $data_produk_pesanans)
                                    @foreach ($data_pesanan as $data_pesanans)
                                        @if ($data_produk_pesanans->pesanan_id == $data_pesanans->id && $data_pesanans->status_pesanan=="Menunggu Pembayaran")
                                        <div class="item-list">
                                            @foreach ($data_gambar_produk as $data_gambar_produks)
                                                @if ($data_gambar_produks->produk_id == $data_produk_pesanans->produk_id)
                                                <div class="avatar">
                                                    <img src="{{ asset('gambar/gambar_produk') }}/{{ $data_gambar_produks->gambar1 }}" alt="..." class="avatar-img rounded-circle">
                                                </div>
                                                @endif
                                            @endforeach
                                            <div class="info-user ml-3">
                                                <div class="username">{{ $data_produk_pesanans->nama_produk }}</div>
                                                <div class="status">{{ $data_produk_pesanans->ukuran_produk }}</div>
                                            </div>
                                            <button class="btn btn-icon btn-primary btn-round btn-xs">
                                                <i class="flaticon-success"></i>
                                            </button>
                                        </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-12">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="card-title fw-mediumbold">Kasir</div>
                            <div class="card-list">
                                <input type="number" class="form-control" id="bayar" placeholder="Masukkan Pembayaran Kostumer">
                                <input type="hidden" id="total" value="{{ $final_bayar }}">
                                    <div>
                                        <label> Pembayaran </label>
                                        <h1 id="pembayaranText">Rp. 0</h1>
                                    </div>
                                    <div>
                                        <label> Kembalian </label>
                                        <h1 id="kembalianText">Rp. 0</h1>
                                    </div>
                                    <div class="mt-4">
                                        <form action="{{ route('AdminKonfirmasiPembayaran') }}" method="POST">
                                        @csrf
                                            @foreach ($data_pesanan as $data_pesanans)
                                                <input type="hidden" value="{{ $data_pesanans->id }}" name="id[]">
                                            @endforeach
                                            <button type="submit" id="saveButton" disabled class="btn btn-success ative btn-block"> 
                                                <i class="fas fa-save"></i>
                                                Simpan Transaksi
                                            </button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-12 col-md-12">
                <div class="card card-round">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header" style="padding: 0.1rem 1.0rem;">
                                <h4 class="card-title">Histori Pemesanan Langsung</h4>
                            </div>
                            <div class="table-responsive">
                                <table id="data_histori_pemesanan_langsung" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Diskon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_produk as $data_produks)
                                        <tr>
                                            <td>{{$data_produks->name}}</td>
                                            <td>@currency($data_produks->harga)</td>
                                            <td>{{ $data_produks->diskon }}%</td>

                                            <td>
                                        <button type="submit" class="btn btn-primary btn-block btn-xs" data-toggle="modal"
                                                data-target="#pilihProduk-{{ $data_produks->id }}"><b>Pilih</b></button>
                                            <form action="{{ route('AdminMasukkanKeranjang') }}" method="POST">
                                                @csrf
                                                <div class="modal fade" id="pilihProduk-{{ $data_produks->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-striped table-bordered text-center">
                                                                    <input type="hidden" name="harga" value="{{ $data_produks->harga }}" hidden>
                                                                    <input type="hidden" name="produk_id" value="{{ $data_produks->id }}" hidden>
                                                                    <tr>
                                                                        <td><strong>Nama Produk</strong></td>
                                                                        <td colspan="4">{{ $data_produks->name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Harga Produk</strong></td>
                                                                        <td colspan="4">
                                                                            @php
                                                                                $harga_diskon = App\Models\Produk::tampilDiskon($data_produks['id']);
                                                                            @endphp
                                                                            @if($harga_diskon>0)
                                                                                <label class="placeholder"><del>@currency($data_produks->harga)</del></label>
                                                                            @else
                                                                                <ins><label class="text-success">@currency($data_produks->harga)</label></ins>
                                                                            @endif
                                                                            @if($harga_diskon>0)
                                                                                <ins><label class="text-success">@currency($harga_diskon)</label></ins>
                                                                            @endif
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Diskon %</strong></td>
                                                                        <td colspan="4">{{ $data_produks->diskon }}%</td>
                                                                    </tr>
                                                                    @foreach ($data_produk_atribut as $data_produk_atributs)
                                                                        @if($data_produk_atributs->produk_id == $data_produks->id)
                                                                            <tr>
                                                                                <td><strong>Ukuran</strong></td>
                                                                                <td>{{ $data_produk_atributs->ukuran }}</td>
                                                                                <td><strong>Stok</strong></td>
                                                                                <td>{{ $data_produk_atributs->stok }}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                    <tr>
                                                                        <td><strong>Masukkan Ukuran</strong></td>
                                                                        <td colspan="4">
                                                                            <div class="form-group">
                                                                                <div class="selectgroup w-100">
                                                                                    @foreach ($data_produk_atribut as $data_produk_atributs)
                                                                                    @if($data_produk_atributs->produk_id == $data_produks->id)
                                                                                    <label class="selectgroup-item">
                                                                                        <input type="radio" name="ukuran" value="{{ $data_produk_atributs->ukuran }}" class="selectgroup-input" checked="" required>
                                                                                        <span class="selectgroup-button">{{ $data_produk_atributs->ukuran }}</span>
                                                                                    </label>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Masukkan Kuantitas</strong></td>
                                                                        <td colspan="4">
                                                                            <div class="product-details-quantity">
                                                                                <input type="number" name="kuantitas" id="kuantitas" class="form-control" value="1" min="1" max="" step="1" data-decimals="0" required>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
    </div>
</div>
@endsection
@section('footer')
<script>
    bayar.oninput = () => {
        const paymentAmount = document.getElementById("bayar").value
        const totalAmount = document.getElementById("total").value

        const kembalian = paymentAmount - totalAmount

        document.getElementById("kembalianText").innerHTML = `Rp. ${rupiah(kembalian)} ,00`
        document.getElementById("pembayaranText").innerHTML = `Rp. ${rupiah(paymentAmount)} ,00`

        const saveButton = document.getElementById("saveButton")
        if (kembalian < 0) {
            saveButton.disabled = true
        } else {
            saveButton.disabled = false
        }
    }
    const rupiah = (angka) => {
        const numberString = angka.toString()
        const split = numberString.split(',')
        const sisa = split[0].length % 3
        let rupiah = split[0].substr(0, sisa)
        const ribuan = split[0].substr(sisa).match(/\d{1,3}/gi)

        if (ribuan) {
            const separator = sisa ? '.' : ''
            rupiah += separator + ribuan.join('.')
        }
        return split[1] != undefined ? rupiah + ',' + split[1] : rupiah
    }

    $('select[id="ukuran"]').on('change', function () {
        let atributId = $(this).val();
		var data_max = $(this).attr('max');
        if (atributId) {
            jQuery.ajax({
                url: '/atribut/'+atributId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('#stok').attr("max", response).val(1);
                },
            });
        } else {
            $('input[name="kuantitas"]').append('<input value="" min="1" max="" step="1" data-decimals="0" required>');
        }
    });
</script>
@endsection