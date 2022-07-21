<div class="tab-pane" id="dikemas">

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="products mb-3">
                        @foreach ($pesanan as $pesanans)
                        @if($pesanans->status_pesanan == "Dikemas")
                        <button type="button" class="btn btn-block btn-danger btn-xs">Kode Pesanan : {{$pesanans->id}}</button>
                        <br><br>
                            @foreach ($produkDiPesan as $produkDiPesans)
                            @if($produkDiPesans->pesanan_id == $pesanans->id)

                            <div class="product product-list">
                                <div class="row">
                                    <div class="col-6 col-lg-3">
                                        <figure class="product-media">
                                            <a href="product.html">
                                                @foreach ($gambarProduk as $gambarProduks)
                                                    @if ($produkDiPesans->produk->id == $gambarProduks->produk_id)
                                                        <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduks->gambar1 }}" alt="Product image" class="product-image">
                                                    @endif
                                                @endforeach
                                            </a>
                                        </figure><!-- End .product-media -->
                                    </div><!-- End .col-sm-6 col-lg-3 -->
    
                                    <div class="col-6 col-lg-3 order-lg-last">
                                        <div class="product-list-action">
                                            <div class="product-price">
                                                <span>@currency($produkDiPesans->harga_produk)</span>
                                            </div><!-- End .product-price -->
                                            <div class="ratings-container">
                                                <span>x{{ $produkDiPesans->kuantitas }}</span>
                                            </div><!-- End .rating-container -->
                                            <div class="product-action">
                                                <span>Ukuran : {{ $produkDiPesans->ukuran_produk }}</span>
                                            </div><!-- End .product-action -->
                                            @php
                                                $total_pesanan = $produkDiPesans->kuantitas * $produkDiPesans->harga_produk
                                            @endphp
    
                                            <a href="#" class="btn-product btn-cart" style="background-color: white;color;color: #3b025b;border-color: #3b025b;"><span>Total Pesanan : @currency($total_pesanan)</span></a>
                                        </div><!-- End .product-list-action -->
                                    </div><!-- End .col-sm-6 col-lg-3 -->
    
                                    <div class="col-lg-6">
                                        <div class="product-body product-action-inner">
                                            {{-- <a href="#" class="btn-product btn-wishlist" title="Add to wishlist"><span>add to wishlist</span></a> --}}
                                            {{-- <div class="product-cat">
                                                <a href="#">x{{ $produkDiPesans->kuantitas }}</a>
                                            </div><!-- End .product-cat --> --}}
                                            <h3 class="product-title"><a href="product.html">{{ $produkDiPesans->nama_produk }}</a></h3><!-- End .product-title -->
    
                                            <div class="product-content">
                                                <p>{{ $produkDiPesans->produk->deskripsi_singkat }}</p>
                                            </div><!-- End .product-content -->
                                            
                                            <div class="product-nav product-nav-thumbs">
                                            @foreach ($gambarProduk as $gambarProduks)
                                                @if ($produkDiPesans->produk->id == $gambarProduks->produk_id)
                                                    <a href="#" class="active">
                                                        <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduks->gambar2 }}" alt="product desc">
                                                    </a>
                                                    <a href="#">
                                                        <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduks->gambar3 }}" alt="product desc">
                                                    </a>
        
                                                    <a href="#">
                                                        <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduks->gambar4 }}" alt="product desc">
                                                    </a>
                                                @endif
                                            @endforeach
                                            </div><!-- End .product-nav -->
                                        </div><!-- End .product-body -->
                                    </div><!-- End .col-lg-6 -->
                                </div><!-- End .row -->
                            </div>
                            @endif
                            @endforeach
                            @endif
                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
