@extends('Admin.Layouts.master')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header" style="padding: 0.1rem 1.0rem;">
                                        <h4 class="card-title">Produk Pesanan</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="produk_pesanan" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama Produk</th>
                                                    <th>Kuantitas</th>
                                                    <th>Harga Produk</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produkDiPesan as $produkDiPesans)
                                                <tr>
                                                    <td>{{$produkDiPesans->nama_produk}}</td>
                                                    <td>{{$produkDiPesans->kuantitas}}</td>
                                                    <td>@currency($produkDiPesans->harga_produk)</td>
                                                    @php
                                                    $sub_total = $produkDiPesans->harga_produk *
                                                    $produkDiPesans->kuantitas
                                                    @endphp
                                                    <td>@currency($sub_total)</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header" style="padding: 0.1rem 1.0rem;">
                                        <h4 class="card-title">Alamat Pengiriman</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="alamat_pengiriman" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama Penerima</th>
                                                    <th>Alamat</th>
                                                    <th>Nomor Hp</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$pesananPelanggan->user->name}}</td>
                                                    <td>{{$pesananPelanggan->alamat->alamat}},
                                                        {{$pesananPelanggan->alamat->kota->name}},
                                                        {{$pesananPelanggan->alamat->provinsi->name}},
                                                        {{$pesananPelanggan->alamat->negara}}</td>
                                                    <td>{{$pesananPelanggan->alamat->nomor_hp}}</td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-6 col-md-12">
                            <div class="card-header" style="padding: 0.1rem 1.0rem;">
                                <h4 class="card-title" style="font-size: 14px;">Ringkasan</h4>
                            </div>
                            <div class="card card-pricing">
                                <ul class="specification-list">
                                    <li>
                                        <span class="name-specification">Total</span>
                                        <span
                                            class="status-specification">@currency($pesananPelanggan->total_bayar)</span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Status Pesanan</span>
                                        <span class="status-specification" style="color: red">
                                            {{ $pesananPelanggan->status_pesanan }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Bukti Transfer</span>
                                    </li>
                                    <li style="display: inline;">
                                        <img class="card-img-top"
                                            src="../member/bukti_bayar/{{$transferPembayaran->bukti_bayar}}"
                                            alt="Card image cap" style="width: min-content; width: 40%;">
                                    </li>
                                </ul>
                                <div class="card-footer" style="padding: 0rem 1.0rem;">
                                    @if ($transferPembayaran->status_verifikasi == "Sudah Di Verifikasi")
                                    <button type="submit" class="btn btn-primary btn-block btn-xs"><b>Telah Di Verifikasi</b></button>
                                    @else
                                    <button type="submit" class="btn btn-primary btn-block btn-xs" data-toggle="modal"
                                    data-target="#verifikasiPembayaran"><b>Verifikasi Pembayaran</b></button>
                                    @endif
                                    <form action="{{ route('VerifikasiPembayaran') }}" method="POST">
                                        @csrf
                                        <div class="modal fade" id="verifikasiPembayaran" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin ingin Memverifikasi Pembayaran?
                                                        <input type="hidden" name="pesanan_id"
                                                            value="{{ $transferPembayaran->pesanan_id }}">
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
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-sm-6 col-md-12">
                            <div class="card-header"style="padding: 0.1rem 1.0rem; ">
                                <h4 class="card-title" style="font-size: 14px;">Bukti Pembayaran</h4>
                            </div>
                            <div class="card card-pricing" style="padding: 0.1rem 1.0rem;display: block;">
                                <img class="card-img-top" src="../member/bukti_bayar/{{$transferPembayaran->bukti_bayar}}"
                        alt="Card image cap" style="width: min-content;">
                    </div>
                    <div class="card-footer" style="padding: 0rem 1.0rem;">
                        <button class="btn btn-primary btn-block btn-xs"><b>Verifikasi Pembayaran</b></button>
                    </div>
                </div> --}}
                <div class="col-sm-6 col-md-12">
                    <div class="card-header" style="padding: 0.1rem 1.0rem;">
                        <h4 class="card-title" style="font-size: 14px;">Perbarui Status Pesanan</h4>
                    </div>
                    <div class="card card-pricing">
                        <form action="{{ route('StatusPesananLogs') }}" method="POST">
                            @csrf
                             <ul class="specification-list">
                                <li>
                                    <input type="hidden" name="pesanan_id" value="{{ $pesananPelanggan->id }}">
                                    <select name="pesanan_status" id="pesanan_status" class="form-control">
                                        <option value="#" selected disabled > -- Pilih Status --</option>
                                        @if ($pesananPelanggan->status_pesanan == "Pending")
                                        <option value="Dikemas">Dikemas</option>
                                        @elseif ($pesananPelanggan->status_pesanan == "Dikemas")
                                        <option value="Dikirim">Dikirim</option>
                                        @elseif($pesananPelanggan->status_pesanan == "Dikirim")
                                        <option value="Terkirim">Terkirim</option>
                                        @elseif($pesananPelanggan->status_pesanan == "Terkirim")
                                        <option value="#" selected disabled> -- Selesai --</option>
                                        @endif
                                    </select>
                                    <hr>
                                    @if ($pesananPelanggan->status_pesanan == "Dikemas")
                                    <input class="form-control" type="text" name="resi" id="resi"
                                        placeholder="Input Nomor Resi" required>
                                    @else
                                    <input class="form-control" type="text" name="resi"
                                        value="{{ $pesananPelanggan->resi }}" id="resi"
                                        placeholder="Input Nomor Resi">
                                    @endif
                                </li>
                                <div class="card-footer" style="padding: 0rem 1.0rem;">
                                    @if($pesananPelanggan->status_pesanan == "Terkirim")
                                    @else
                                    <button type="submit" class="btn btn-primary btn-block btn-xs">
                                        <b>Ubah Status Pesanan</b>
                                    </button>
                                    @endif
                                    <div>
                            </ul>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="produk_pesanan" class="display table table-striped table-hover">
                            @foreach ($pesanan_logs as $logs)
                            <tr>
                                <td>{{$logs->pesanan_status}}</td>
                                <td>{{ date('F j, Y, g:i a', strtotime($logs->created_at)) }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
@endsection
@section('footer')

<script>
    $("#resi").hide();
    $("#pesanan_status").on("change", function () {
        if (this.value == "Dikirim") {
            $("#resi").show();
        } else {
            $("#resi").hide();
        }
    });

</script>

@endsection
