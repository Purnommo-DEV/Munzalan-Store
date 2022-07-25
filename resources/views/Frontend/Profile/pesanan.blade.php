<div class="active tab-pane" id="pesanan">
    <div class="row">
        <div class="col-md-12">
            @foreach($pesanan as $pesanans)
            <div class="accordion accordion-icon" id="accordion-3">
                <div class="card">
                    <div class="card-header" id="heading3-2">
                        <h2 class="card-title">
                            <a role="button" data-toggle="collapse" href="#tampil-{{ $pesanans->id }}" aria-expanded="true" aria-controls="collapse3-1" style="font-size: initial;">
                                
                                <div class="card-header">
                                    Kode Pemesanan : {{ $pesanans->id }} 
                                </div>
                                <div class="card-body">
                                <h6 class="card-title">Status : {{ $pesanans->status_pesanan }}</h6>
                                <p class="card-text">Pesanan di buat : {{ $pesanans->created_at->diffForHumans() }} ({{ $pesanans->created_at->toFormattedDateString()}})</p>
                                </div>
                                </a>
                        </h2>
                    </div><!-- End .card-header -->
                    <div id="tampil-{{ $pesanans->id }}" class="collapse" aria-labelledby="heading3-1" data-parent="#accordion-3">
                        <div class="entry-item lifestyle shopping col-sm-6">
                            <div class="entry-body">
                                <table class="table table-striped table-bordered text-center">
                                    <tr>
                                        <td colspan="2"><strong>Pesanan Detail</strong>
                                    </tr>
                                    <tr>
                                        <td>Pesanan</td>
                                        <td>Tanggal : {{$pesanans->created_at}}<br>Status Pesanan : {{ $pesanans->status_pesanan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Penerima</td>
                                        <td>{{$pesanans->alamat->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>{{$pesanans->alamat->alamat}}, {{$pesanans->alamat->kota->name}},
                                            {{$pesanans->alamat->provinsi->name}},
                                            {{$pesanans->alamat->negara}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$pesanans->alamat->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Hp</td>
                                        <td>{{$pesanans->alamat->nomor_hp}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Pemesanan</td>
                                        <td>@currency($pesanans->total_bayar) (Note : Sudah Termasuk Ongkos Kirm & Tidak Termasuk Biaya
                                            Transfer Admin)</td>
                                    </tr>
                                    <tr>
                                        <td>Metode Pembayaran</td>
                                        <td>{{$pesanans->metode_pembayaran}}</td>
                                    </tr>
                                    <tr>
                                        <td>Berat Pesanan</td>
                                        <td>{{$pesanans->total_berat}}(g)</td>
                                    </tr>
                                    <tr>
                                        <td>Pengiriman</td>
                                        <td>{{$pesanans->pengiriman}} - @currency($pesanans->ongkos_kirim)</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- End .entry-item -->
            
                        <div class="entry-item lifestyle shopping col-sm-6">
                            <div class="entry-body">
                                @foreach ($buktiTransfer as $buktiTransfers)
                                @if($pesanans->id == $buktiTransfers->pesanan_id)
                                <table class="table table-striped table-bordered text-center">
                                    <tr>
                                        <td colspan="2"><strong>Bukti Pembayaran</strong>
                                    </tr>
                                    <tr>
                                        <td>Asal Bank</td>
                                        <td>{{$buktiTransfers->asal_bank}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pengirim</td>
                                        <td>{{$buktiTransfers->nama_pengirim}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Rekening</td>
                                        <td>{{$buktiTransfers->nomor_rekening}}</td>
                                    </tr>
                                    <tr>
                                        <td>Bukti Transfer</td>
                                        <td style="width: min-content;">
                                            <img src="../member/bukti_bayar/{{$buktiTransfers->bukti_bayar}}" alt="" width="300"></td>
                                    </tr>
                                    <tr>
                                        <td>Status Verifikasi</td>
                                        <td>
                                            @if ($buktiTransfers->status_verifikasi == "Belum Di Verifikasi")
                                            <button type="button"
                                                class="btn btn-block btn-danger btn-xs">{{$buktiTransfers->status_verifikasi}}</button>
                                            @else
                                            <button type="button"
                                                class="btn btn-block btn-primary btn-xs">{{$buktiTransfers->status_verifikasi}}</button>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                @endif
                                @endforeach
                            </div>
                        </div>
            
                        <div class="entry-item lifestyle shopping col-sm-12">
                            <div class="entry-body">
                                <table class="table table-striped table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <td colspan="5"><strong>Produk Pesanan</strong></td>
                                        </tr>
                                        <tr>
                                            <th><strong>Gambar</strong></th>
                                            <th><strong>Nama</strong></th>
                                            <th><strong>Ukuran</strong></th>
                                            <th><strong>Harga</strong></th>
                                            <th><strong>Kuantitas</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($produkDiPesan as $produkDiPesans)
                                        @if($produkDiPesans->pesanan_id == $pesanans->id)
                                        <tr>
                                            <td style="width: min-content;">
                                                <img src="{{ asset('gambar/gambar_produk') }}/{{ $produkDiPesans->gambarProduk->gambar1 }}" width="100">
                                            </td>
                                            <td>{{$produkDiPesans->nama_produk}}</td>
                                            <td>{{$produkDiPesans->ukuran_produk}}</td>
                                            <td>@currency($produkDiPesans->harga_produk)</td>
                                            <td>{{$produkDiPesans->kuantitas}}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End .collapse -->
                </div><!-- End .card -->
            </div><!-- End .accordion -->
            @endforeach
        </div>
    </div>
</div>