

@foreach($data_favorit as $data_favorits)
    <div class="product product-list ">
        <div class="row">
            <div class="col-4 col-lg-3">
                <figure class="product-media">
                    {{-- <span class="product-label label-new">New</span> --}}
                    <a href="{{ route('HalamanDetailProduk', $data_favorits->produk->slug) }}">
                        @foreach ($gambar_produk as $gambar_produks)
                        @if ($data_favorits->produk_id == $gambar_produks->produk_id)
                            <img src="{{asset('gambar/gambar_produk')}}/{{$gambar_produks->gambar1}}" alt="{{$data_favorits->name}}" class="product-image">
                        @endif
                        @endforeach
                    </a>
                </figure><!-- End .product-media -->
            </div><!-- End .col-sm-6 col-lg-3 -->
        
            <div class="col-4 col-lg-3 order-lg-last">
                <div class="product-list-action">
                    <div class="product-price" style="justify-content: center;">
                        @php
                            $harga_diskon = \App\Models\Produk::tampilDiskon($data_favorits['produk_id']); 
                        @endphp
                        @if($harga_diskon>0)
                            <del><span class="old-price">@currency($data_favorits->produk->harga)</span></del>
                        @else
                            <span class="new-price">@currency($data_favorits->produk->harga)</span>
                        @endif
                        @if($harga_diskon>0)
                            <span class="new-price">@currency($harga_diskon)</span>
                        @endif
    
                    </div>
                    <div class="ratings-container" style="justify-content: center;line-height: inherit;">
                        @if (App\Models\Penilaian::where('produk_id',$data_favorits->produk_id)->first())
                            @php
                                $statusPenilaianProduk = App\Models\PesananProduk::where('produk_id', $data_favorits->produk_id)->where('status_penilaian',1)->get();
                                $rating = App\Models\Penilaian::where('produk_id',$data_favorits->produk_id)->avg('bintang');
                                $avgRating = number_format($rating,1);
                            @endphp
                        <?php $star = 1;
                            while($star <= $avgRating){ ?>
                            <label for="rating2" class="ratings-text icon-star-o" style="color:orange;"></label>
                        <?php $star++; } ?>
                            <label class="ratings-text" style="color:chocolate">({{$avgRating}})</label>
                            <label class="ratings-text" style="color:chocolate">({{count($statusPenilaianProduk)}}) Review</label>
                        @else
                            <span class="text-danger">Belum Ada Review</span>
                        @endif
                    </div>
                    {{-- <div class="product-action">
                        <a href="popup/quickView.html" class="btn-product btn-quickview"
                            title="Quick view"><span>quick view</span></a>
                        <a href="#" class="btn-product btn-compare"
                            title="Compare"><span>compare</span></a>
                    </div><!-- End .product-action --> --}}
        
                    <a href="{{ route('HalamanDetailProduk', $data_favorits->produk->slug) }}" class="btn-product btn-cart"><span>Lihat Detail</span></a>
                </div><!-- End .product-list-action -->
            </div><!-- End .col-sm-6 col-lg-3 -->
        
            <div class="col-lg-6">
                <div class="product-body product-action-inner">
                    <a href="#" class="btn-product btn-wishlist btnProdukFavoritHapus" data-cartid = "{{ $data_favorits->id }}" style="color: red;"></a>
                    {{-- <a href="#" class="btn-product btn-wishlist btnProdukFavoritDelete" data-cartid = {{ $data_favorits->id }}></a> --}}
                    <div class="product-cat">
                        <a href="#">{{ $data_favorits->produk->kategori->name }}</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title">
                        <a href="{{ route('HalamanDetailProduk', $data_favorits->produk->slug) }}">{{ $data_favorits->produk->name }}</a>
                    </h3><!-- End .product-title -->
        
                    <div class="product-content">
                        <p>{{ $data_favorits->produk->deskripsi_singkat }}</p>
                    </div><!-- End .product-content -->
        
                    <div class="product-nav product-nav-thumbs">
                        @foreach ($gambar_produk as $gambar_produks)
                            @if ($data_favorits->produk_id == $gambar_produks->produk_id)
                            <a href="#" class="active">
                                @if ($gambar_produks->gambar2 == NUll)
                                <img src="{{ asset('gambar/tanpa_gambar/tanpaGambar.png') }}">
                                @else
                                <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambar_produks->gambar2 }}">
                                @endif
                            </a>   
                            <a href="#" class="active">
                                @if ($gambar_produks->gambar3 == NUll)
                                <img src="{{ asset('gambar/tanpa_gambar/tanpaGambar.png') }}">
                                @else
                                <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambar_produks->gambar3 }}">
                                @endif
                            </a>                                            
                            <a href="#" class="active">
                                @if ($gambar_produks->gambar4 == NUll)
                                <img src="{{ asset('gambar/tanpa_gambar/tanpaGambar.png') }}">
                                @else
                                <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambar_produks->gambar4 }}">
                                @endif
                            </a>   
                            <a href="#" class="active">
                                @if ($gambar_produks->gambar5 == NUll)
                                <img src="{{ asset('gambar/tanpa_gambar/tanpaGambar.png') }}">
                                @else
                                <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambar_produks->gambar5 }}">
                                @endif
                            </a> 
                            @endif
                        @endforeach
                    </div><!-- End .product-nav -->
                </div><!-- End .product-body -->
            </div><!-- End .col-lg-6 -->
        </div><!-- End .row -->               
    </div>
@endforeach