@php
    use App\Models\Produk;
@endphp

<div class="row justify-content-center">
    @foreach ($data_produk as $data_produks)
    <div class="col-6 col-md-4 col-lg-4">
        <div class="product product-7 text-center">
            <figure class="product-media">
                {{-- <span class="product-label label-new">New</span> --}}
                <a href="{{ route('HalamanDetailProduk', $data_produks->slug) }}">
                    @foreach ($gambar_produk as $gambar_produks)
                    @if ($data_produks->id == $gambar_produks->produk_id)
                        <img src="{{asset('gambar/gambar_produk')}}/{{$gambar_produks->gambar1}}" alt="{{$data_produks->name}}" class="product-image">
                    @endif
                    @endforeach
                </a>

                {{-- <div class="product-action-vertical">
                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                    <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                    <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                </div><!-- End .product-action-vertical --> --}}

                <div class="product-action">
                    <a href="{{ route('HalamanDetailProduk', $data_produks->slug) }}" class="btn-product btn-quickview"><span>Lihat Detail</span></a>
                </div><!-- End .product-action -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat">
                    <a href="{{ route('HalamanDetailProduk', $data_produks->slug) }}">{{ $data_produks->kategori->name }}</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title">
                    <a href="{{ route('HalamanDetailProduk', $data_produks->slug) }}">{{ $data_produks->name }}</a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    @php
                        $harga_diskon = Produk::tampilDiskon($data_produks['id']); 
                    @endphp
                    @if($harga_diskon>0)
                        <del><span class="old-price">@currency($data_produks->harga)</span></del>
                    @else
                        <span class="new-price">@currency($data_produks->harga)</span>
                    @endif
                    @if($harga_diskon>0)
                        <span class="new-price">@currency($harga_diskon)</span>
                    @endif

                </div>

                <div class="ratings-container">
                    @if (App\Models\Penilaian::where('produk_id',$data_produks->id)->first())
                        @php
                            $statusPenilaianProduk = App\Models\PesananProduk::where('produk_id', $data_produks->id)->where('status_penilaian',1)->get();
                            $rating = App\Models\Penilaian::where('produk_id',$data_produks->id)->avg('bintang');
                            $avgRating = number_format($rating,1);
                        @endphp
                    <?php $star = 1;
                        while($star <= $avgRating){ ?>
                        <label for="rating2" class="icon-star-o" style="color:orange;"></label>
                    <?php $star++; } ?>

                        <span class="ratings-text" style="color:chocolate">({{$avgRating}})</span>
                        <span class="ratings-text" style="color:chocolate">({{count($statusPenilaianProduk)}}) Review</span>
                    @else
                        <span class="text-danger">Belum Ada Review</span>
                    @endif
                </div>

                <div class="product-nav product-nav-thumbs">
                    @foreach ($gambar_produk as $gambar_produks)
                        @if ($data_produks->id == $gambar_produks->produk_id)
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
        </div><!-- End .product -->
    </div><!-- End .col-sm-6 col-lg-4 -->
    @endforeach

</div><!-- End .row -->