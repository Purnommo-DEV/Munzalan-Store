<div class="active tab-pane" id="pesanan">


  <div class="card-body pb-0" style="-ms-flex: 1 1 auto;flex: 1 1 auto;min-height: 1px;padding: 1.25rem;padding-top: 1.25rem;padding-right: 1.25rem;padding-bottom: 1.25rem;padding-left: 1.25rem;">
        <div class="row">
            @foreach($pesanan as $pesanans)
            <div class="col-md-12" style="-ms-flex: 0 0 100%;flex: 0 0 50%;max-width: 100%;">
                <div class="card card-widget"
                    style="position: relative;display: -ms-flexbox;display: flex;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 0 solid rgba(0,0,0,.125);border-radius: .25rem;">
                    <div class="card-header"
                        style="background-color: transparent;border-bottom: 1px solid rgba(0,0,0,.125);padding: .75rem 1.25rem;position: relative;border-top-left-radius: .25rem;border-top-right-radius: .25rem;">
                        <div class="table-responsive">
                            <table class="table m-0 text-center" style="margin-bottom: 0px;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Kode Pesanan</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Nomor Hp</th>
                                        <th class="text-center">Total Bayar</th>
                                        <th class="text-center">Metode Pembayaran</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$pesanans->id}}</td>
                                        <td>{{$pesanans->alamat}}</td>
                                        <td>{{$pesanans->nomor_hp}}</td>
                                        <td>@currency($pesanans->total_bayar)</td>
                                        <td>{{$pesanans->metode_pembayaran}}</td>
                                        <td>
                                            <button type="button" class="btn btn-tool" title="Mark as read">
                                                <i class="far fa-circle"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body pb-0"
                    style="-ms-flex: 1 1 auto;flex: 1 1 auto;min-height: 1px;padding: 1.25rem;padding-top: 1.25rem;padding-right: 1.25rem;padding-bottom: 1.25rem;padding-left: 1.25rem;">
                    @foreach ($buktiTransfer as $buktiTransfers)
                    @if($pesanans->id == $buktiTransfers->pesanan_id)
                      <div class="row">
                        <div class="card-header">
                          <h4 class="card-title">&nbsp;&nbsp;Bukti Transfer</h4>
                        </div>
                        <div class="col-md-6" style="-ms-flex: 0 0 100%;flex: 0 0 50%;max-width: 100%;">
                          <div class="card">
                            <div class="card-body pb-0"
                            style="-ms-flex: 1 1 auto;flex: 1 1 auto;min-height: 1px;padding: 1.25rem;padding-top: 1.25rem;padding-right: 1.25rem;padding-bottom: 1.25rem;padding-left: 1.25rem; margin-top: -10px;"">
                              <dl>
                                <dt>Asal Bank</dt>
                                <dd>{{$buktiTransfers->asal_bank}}</dd>
                                <dt>Nama Pengirim</dt>
                                <dd>{{$buktiTransfers->nama_pengirim}}</dd>
                                <dt>Nomor Rekening</dt>
                                <dd>{{$buktiTransfers->nomor_rekening}}</dd>
                              </dl>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6" style="-ms-flex: 0 0 100%;flex: 0 0 50%;max-width: 100%;">
                          <div class="card">
                            <div class="card-body">
                              <img src="../member/bukti_bayar/{{$buktiTransfers->bukti_bayar}}" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                      @endif
                      @endforeach
                      <div class="card-body pb-0"
                      style="-ms-flex: 1 1 auto;flex: 1 1 auto;min-height: 1px;padding: 1.25rem;padding-top: 1.25rem;padding-right: 1.25rem;padding-bottom: 1.25rem;padding-left: 1.25rem; margin-top: -2rem;">
                            <div class="row">
                              <div class="card-header">
                                <h4 class="card-title">Produk Dipesan</h4>
                              </div>
                                @foreach($produkDiPesan as $produkDiPesans)
                                @if($pesanans->id == $produkDiPesans->pesanan_id)
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill"
                                        style="position: relative;display: -ms-flexbox;display: flex;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 0 solid rgba(0,0,0,.125);border-radius: .25rem;">
                                        <div class="card-body pt-0"
                                        style="-ms-flex: 1 1 auto;flex: 1 1 auto;min-height: 1px;padding: 1.25rem;margin-top: -20px;">
                                            <div class="row"
                                                style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -7.5px;">
                                                <div class="col-7" style="flex: 0 0 58.333333%;max-width: 58.333333%;">
                                                    <h2 class="lead" style="font-size: 1.25rem;font-weight: 300; margin-top: 10px;">
                                                        <b>{{$produkDiPesans->nama_produk}}</b></h2>
                                                    <p class="text-muted text-sm"
                                                        style="font-size: .875rem !important;"><b>Ukuran produk: </b>
                                                        {{$produkDiPesans->ukuran_produk}}</p>
                                                    <p class="text-muted text-sm"
                                                        style="font-size: .875rem !important;"><b>Harga Produk: </b>
                                                        @currency($produkDiPesans->harga_produk)</p>
                                                    <p class="text-muted text-sm"
                                                        style="font-size: .875rem !important;"><b>Kuantitas: </b>
                                                        {{$produkDiPesans->kuantitas}}</p>
                                                </div>
                                                <div class="col-5 text-center" style="-ms-flex: 0 0 41.666667%;flex: 0 0 41.666667%;max-width: 41.666667%;">
                                                    @foreach ($gambarProduk as $gambarProduks)
                                                        @if ($produkDiPesans->produk->id == $gambarProduks->produk_id)
                                                            <img src="../frontend/assets/images/products/{{$gambarProduks->gambar1}}" alt="user-avatar" class="img-circle img-fluid" style="max-width: 100%;height: auto;">
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @if ($buktiTransfers->status_verifikasi == "Belum Di Verifikasi")
                                <button type="button" class="btn btn-block btn-danger btn-xs">{{$buktiTransfers->status_verifikasi}}</button>
                                @else
                                <button type="button" class="btn btn-block btn-primary btn-xs">{{$buktiTransfers->status_verifikasi}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</div>
</div>
