<div class="tab-pane" id="dikirim">
       <div class="card-body pb-0"
        style="-ms-flex: 1 1 auto;flex: 1 1 auto;min-height: 1px;padding: 1.25rem;padding-top: 1.25rem;padding-right: 1.25rem;padding-bottom: 1.25rem;padding-left: 1.25rem;">
        <div class="widget mercado-widget widget-product">
            <div class="widget-content">
                <ul class="products">
                    @foreach ($pesanan as $pesanans)
                    @if($pesanans->status_pesanan == "Dikirim")
                    
                    <button type="button" class="btn btn-block btn-danger btn-xs">Kode Pesanan :
                        {{$pesanans->id}}</button>
                    @foreach ($produkDiPesan as $produkDiPesans)
                    @if($produkDiPesans->pesanan_id == $pesanans->id)
                    <div class="col-md-6" style="-ms-flex: 0 0 100%;flex: 0 0 50%;max-width: 100%;">
                        <li class="product-item">
                            <div class="product product-widget-style">
                                <div class="thumbnnail" style="width: 100px;">
                                    <a href="detail.html"
                                        title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                        @foreach ($gambarProduk as $gambarProduks)
                                            @if ($produkDiPesans->produk->id == $gambarProduks->produk_id)
                                                <img src="../frontend/assets/images/products/{{$gambarProduks->gambar1}}" alt="user-avatar" class="img-circle img-fluid" style="max-width: 100%;height: auto;">
                                            @endif
                                        @endforeach
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>{{ $produkDiPesans->nama_produk }}</span></a>
                                    <div><span class="product-name">{{ $produkDiPesans->ukuran_produk }}</span></div>
                                    <div><span class="product-name">@currency($produkDiPesans->harga_produk)</span>
                                    </div>
                                    <div><span class="product-name">x{{ $produkDiPesans->kuantitas }}</span></div>
                                    @php
                                    $total = 0;
                                    $total = $produkDiPesans->kuantitas * $produkDiPesans->harga_produk
                                    @endphp
                                    <div><span class="product-name">Total : @currency($total)</span></div>
                                    <div>
                                        <h2></h2>
                                    <div>
                                </div>
                            </div>
                        </li>
                    </div>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
