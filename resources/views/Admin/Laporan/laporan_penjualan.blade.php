@extends('Admin.Layouts.master')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group form-group-default">
                                        <label for="label">Tanggal Awal</label>
                                        <input type="date" name="tgawal" id="tglawal" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-group-default">
                                        <label for="label">Tanggal Akhir</label>
                                        <input type="date" name="tgakhir" id="tglakhir" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <a href="" onclick="this.href='/cetakLaporanPenjualan/' + 
                                        document.getElementById('tglawal').value + '/' + 
                                        document.getElementById('tglakhir').value" target="_blank"
                                        
                                        class="btn btn-primary btn-round ml-auto">
                                        <i class="fa fa-plus"></i>
                                        Cetak
                                    </a>
                                    {{-- <a href="" class="btn btn-primary btn-round ml-auto" target="_blank">
                                        <i class="fa fa-plus"></i>
                                        Filter
                                    </a> --}}
                                </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="kategoris" class="display table table-striped table-hover text-center" style="font-size: 10%">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kode Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Nama Produk</th>
                                        <th>Kuantitas</th>
                                        <th>Harga Satuan</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pesanan as $data_pesanans)
                                        <tr>
                                            <td>{{ Carbon\Carbon::parse($data_pesanans->created_at)->isoFormat('dddd, D MMMM Y, h:mm A') }}</td>
                                            <td>{{ $data_pesanans->id }}</td>
                                            <td>{{ $data_pesanans->user->name }}</td>
                                            <td colspan="1">
                                            @foreach ($data_pesanan_produk as $data_pesanan_produks)
                                                @if ($data_pesanans->id == $data_pesanan_produks->pesanan_id)
                                                <hr>                                                        {{ $data_pesanan_produks->nama_produk }} ({{ $data_pesanan_produks->ukuran_produk }})<hr>
                                                @endif
                                            @endforeach
                                            </td>
                                            <td colspan="1">
                                                @foreach ($data_pesanan_produk as $data_pesanan_produks)
                                                    @if ($data_pesanans->id == $data_pesanan_produks->pesanan_id)
                                                    <hr>{{ $data_pesanan_produks->kuantitas }}<hr>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td colspan="1">
                                                @foreach ($data_pesanan_produk as $data_pesanan_produks)
                                                @php
                                                    $sub_total = $data_pesanan_produks->harga_produk * $data_pesanan_produks->kuantitas
                                                @endphp
                                                    @if ($data_pesanans->id == $data_pesanan_produks->pesanan_id)
                                                    <hr>@currency($data_pesanan_produks->harga_produk)<hr>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td colspan="1">
                                                    @currency($data_pesanans->total_bayar)
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
    </div>
</div>
<script type="text/javascript">
    window.print();
</script>
@endsection