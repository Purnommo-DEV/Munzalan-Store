@extends('Frontend.Layouts.master', ['title'=>'Detail Produk'])
@section('konten')
@php
use App\Models\Produk;
@endphp

<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
    <div class="container d-flex align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('HalamanBeranda') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Produk Detail</a></li>
        </ol>
        <!-- End .pager-nav -->
    </div>
    <!-- End .container -->
</nav>
<!-- End .breadcrumb-nav -->
<div class="page-content">
    <div class="container">
        <div class="product-details-top mb-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery product-gallery-vertical">
                        <div class="row">
                            <figure class="product-main-image">
                                <img id="product-zoom" src="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar1}}" data-zoom-image="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar1}}" alt="product image">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                            </figure>
                            <!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                <a class="product-gallery-item active" href="#" data-image="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar2}}" data-zoom-image="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar2}}">
                                    <img src="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar2}}" alt="product side">
                                </a>

                                <a class="product-gallery-item" href="#" data-image="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar3}}" data-zoom-image="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar3}}">
                                    <img src="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar3}}" alt="product cross">
                                </a>

                                <a class="product-gallery-item" href="#" data-image="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar4}}" data-zoom-image="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar4}}">
                                    <img src="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar4}}" alt="product with model">
                                </a>

                                <a class="product-gallery-item" href="#" data-image="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar5}}" data-zoom-image="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar5}}">
                                    <img src="{{asset('gambar/gambar_produk')}}/{{$gambar_produk->gambar5}}" alt="product back">
                                </a>
                            </div>
                            <!-- End .product-image-gallery -->
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .product-gallery -->
                </div>
                <!-- End .col-md-6 -->

                <div class="col-md-6">
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
                    <div class="product-details product-details-centered produk-data">
                        <h1 class="product-title">{{$detail_produk->name}}</h1>
                        <!-- End .product-title -->

                        <div class="ratings-container">
                            @if (App\Models\Penilaian::where('produk_id',$detail_produk->id)->first())
                                @php
                                    $statusPenilaianProduk = App\Models\PesananProduk::where('produk_id', $detail_produk->id)->where('status_penilaian',1)->get();
                                    $rating = App\Models\Penilaian::where('produk_id',$detail_produk->id)->avg('bintang');
                                    $avgRating = number_format($rating,1);
                                @endphp
                                <?php $star = 1;
                                    while($star <= $avgRating){ ?>
                                    <label for="rating2" class="icon-star-o" style="color:orange;"></label>
                                <?php $star++; } ?>
                                    <label class="ratings-text" style="color:chocolate">({{$avgRating}})</label>
                                    <label class="ratings-text" href="#product-review-link" style="color:chocolate" id="review-link">
                                        ( {{count($statusPenilaianProduk)}} Reviews )
                                    </label>
                            @else
                                <span class="text-danger">Belum Ada Review</span>
                            @endif
                        </div>
                        <!-- End .rating-container -->

                        <div class="product-price">
                            @php
                                $harga_diskon = Produk::tampilDiskon($detail_produk['id']);
                            @endphp
                            @if($harga_diskon>0)
                            <del>
                                <p class="product-price" style="font-size: 60%; padding:10px;">
                                    @currency($detail_produk->harga)</p>
                            </del>
                            @else
                            <ins>
                                <p class="product-price">@currency($detail_produk->harga)</p>
                            </ins>
                            @endif
                            @if($harga_diskon>0)
                            <ins>
                                <p class="product-price">@currency($harga_diskon)</p>
                            </ins>
                            @endif
                        </div>
                        <!-- End .product-price -->

                        <div class="product-content">
                            <p>{{$detail_produk->deskripsi_singkat}}</p>
                        </div>
                        <!-- End .product-content -->

                        <div class="details-filter-row details-row-size">
                            <label>Stok: <span class="tampilAtributStok"></span></label>
                            <!-- End .product-nav -->
                        </div>
                        <!-- End .details-filter-row -->

                        <form action="{{route('TambahKeKeranjang')}}" method="post">
                        <div class="details-filter-row details-row-size">
                            <label for="size">Size:</label>
                                @csrf
                                    @if (Route::has('HalamanLogin'))
                                        @auth
                                            <input type="hidden" name="user_id" value="{{(Auth::user()->id)}}" hidden>
                                            <input type="hidden" name="produk_id" value="{{$detail_produk->id}}" hidden>
                                            <input type="hidden" name="harga" value="{{$detail_produk->harga}}" hidden>
                                            <input type="hidden" class="tampilBerat" value="" name="berat" hidden>
                                        @endauth
                                    @endif
                            <div class="select-custom">
                                <select name="ukuran" id="tampilHarga" produk-id="{{$detail_produk->id}}"
                                    class="form-control" style="width:200px" required>
                                    <option value="" selected disabled>Pilih Ukuran</option>
                                    @foreach ($produk_atribut as $produk_atributs)
                                    <option value="{{$produk_atributs->ukuran}}">{{$produk_atributs->ukuran}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- End .details-filter-row -->

                        <div class="product-details-action">
                            <div class="details-action-col">
                                <div class="product-details-quantity">
                                    <input type="number" name="kuantitas" id="kuantitas" class="form-control" value="1" min="1" max="" step="1" data-decimals="0" required>
                                </div>
                                    @auth
                                            <a href="#" class="btn-product add-to-cart">
                                                <button style="background:transparent; border:none; width:100%; color:none;">Tambah Ke Keranjang</button>
                                            </a>
                                    @else
                                            <a href="{{route('HalamanLogin')}}" class="btn-product add-to-cart">Tambah Ke Keranjang</a>
                                    @endauth
                            </div>
                            <!-- End .details-action-col -->
                            <input type="hidden" class="produk_id" value="{{$detail_produk->id}}">
                            <div class="details-action-wrapper">
                                <a href="#" class="btn-product btn-wishlist tambahKeFaforitBtn" title="Tambah Favorit"><span>Tambah Favorit</span></a>
                            </div>
                            <!-- End .details-action-wrapper -->
                        </div>
                    </form>
                        <!-- End .product-details-action -->

                        {{-- <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>
                                <a href="#">Women</a>,
                                <a href="#">Dresses</a>,
                                <a href="#">Yellow</a>
                            </div>
                            <!-- End .product-cat -->

                            <div class="social-icons social-icons-sm">
                                <span class="social-label">Share:</span>
                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            </div>
                        </div> --}}
                        <!-- End .product-details-footer -->
                    </div>
                    <!-- End .product-details -->
                </div>
                <!-- End .col-md-6 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .product-details-top -->

        <div class="product-details-tab">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Deskripsi Lengkap</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Penilaian ({{    $hitungPenilaian}})</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <h3>Deskripsi Lengkap</h3>
                        <p>{!!$detail_produk->deskripsi_lengkap!!}
                        </p>
                    </div>
                    <!-- End .product-desc-content -->
                </div>
                <!-- .End .tab-pane -->
                {{-- <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <h3>Information</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget
                            felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. </p>

                        <h3>Fabric & care</h3>
                        <ul>
                            <li>Faux suede fabric</li>
                            <li>Gold tone metal hoop handles.</li>
                            <li>RI branding</li>
                            <li>Snake print trim interior </li>
                            <li>Adjustable cross body strap</li>
                            <li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                        </ul>

                        <h3>Size</h3>
                        <p>one size</p>
                    </div>
                    <!-- End .product-desc-content -->
                </div>
                <!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <h3>Delivery & returns</h3>
                        <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br> We hope you’ll love every purchase, but if you ever need
                            to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                    </div>
                    <!-- End .product-desc-content -->
                </div> --}}
                <!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                    <div class="reviews">
                        @foreach ($tampilPenilaian as $tampil)
                        
                        <div class="review">
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <h4><a href="#">{{ $tampil->user->name }}</a></h4>
                                    <div class="ratings-container">
                                        <?php $star = 1;
                                            while($star <= $tampil->bintang){ ?>
                                            <label for="rating2" class="icon-star-o" style="color:orange;"></label>
                                        <?php $star++; } ?>
                                    </div>
                                    <span class="review-date">
                                        {{$tampil->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="col">
                                    <h3>{{ $tampil->komentar}}</h3>
                                    <div class="review-content">
                                        <img src="{{ asset('gambar/gambar_penilaian') }}/{{ $tampil->gambar}}" width="100">
                                    </div>
                                </div>
                                <!-- End .col-auto -->
                            </div>
                            <!-- End .row -->
                        </div>
                        
                        @endforeach
                    </div>
                    <!-- End .reviews -->
                </div>
                <!-- .End .tab-pane -->
            </div>
            <!-- End .tab-content -->
        </div>
        <!-- End .product-details-tab -->

        {{-- <h2 class="title text-center mb-4">You May Also Like</h2> --}}
        <!-- End .title text-center -->
        {{-- <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                "nav": false, 
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":1
                    },
                    "480": {
                        "items":2
                    },
                    "768": {
                        "items":3
                    },
                    "992": {
                        "items":4
                    },
                    "1200": {
                        "items":4,
                        "nav": true,
                        "dots": false
                    }
                }
            }'>
            <div class="product product-7 text-center">
                <figure class="product-media">
                    <span class="product-label label-new">New</span>
                    <a href="product.html">
                        <img src="assets/images/products/product-4.jpg" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div>
                    <!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                    <!-- End .product-action -->
                </figure>
                <!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Women</a>
                    </div>
                    <!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">Brown paperbag waist <br>pencil skirt</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        $60.00
                    </div>
                    <!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div>
                            <!-- End .ratings-val -->
                        </div>
                        <!-- End .ratings -->
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div>
                    <!-- End .rating-container -->

                    <div class="product-nav product-nav-dots">
                        <a href="#" class="active" style="background: #cc9966;"><span class="sr-only">Color name</span></a>
                        <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                        <a href="#" style="background: #806b3e;"><span class="sr-only">Color name</span></a>
                    </div>
                    <!-- End .product-nav -->
                </div>
                <!-- End .product-body -->
            </div>
            <!-- End .product -->

            <div class="product product-7 text-center">
                <figure class="product-media">
                    <span class="product-label label-out">Out of Stock</span>
                    <a href="product.html">
                        <img src="assets/images/products/product-6.jpg" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div>
                    <!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                    <!-- End .product-action -->
                </figure>
                <!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Jackets</a>
                    </div>
                    <!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">Khaki utility boiler jumpsuit</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        <span class="out-price">$120.00</span>
                    </div>
                    <!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 80%;"></div>
                            <!-- End .ratings-val -->
                        </div>
                        <!-- End .ratings -->
                        <span class="ratings-text">( 6 Reviews )</span>
                    </div>
                    <!-- End .rating-container -->
                </div>
                <!-- End .product-body -->
            </div>
            <!-- End .product -->

            <div class="product product-7 text-center">
                <figure class="product-media">
                    <span class="product-label label-top">Top</span>
                    <a href="product.html">
                        <img src="assets/images/products/product-11.jpg" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div>
                    <!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                    <!-- End .product-action -->
                </figure>
                <!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Shoes</a>
                    </div>
                    <!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">Light brown studded Wide fit wedges</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        $110.00
                    </div>
                    <!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 80%;"></div>
                            <!-- End .ratings-val -->
                        </div>
                        <!-- End .ratings -->
                        <span class="ratings-text">( 1 Reviews )</span>
                    </div>
                    <!-- End .rating-container -->

                    <div class="product-nav product-nav-dots">
                        <a href="#" class="active" style="background: #8b513d;"><span class="sr-only">Color name</span></a>
                        <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                        <a href="#" style="background: #d2b99a;"><span class="sr-only">Color name</span></a>
                    </div>
                    <!-- End .product-nav -->
                </div>
                <!-- End .product-body -->
            </div>
            <!-- End .product -->

            <div class="product product-7 text-center">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="assets/images/products/product-10.jpg" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div>
                    <!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                    <!-- End .product-action -->
                </figure>
                <!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Jumpers</a>
                    </div>
                    <!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">Yellow button front tea top</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        $56.00
                    </div>
                    <!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 0%;"></div>
                            <!-- End .ratings-val -->
                        </div>
                        <!-- End .ratings -->
                        <span class="ratings-text">( 0 Reviews )</span>
                    </div>
                    <!-- End .rating-container -->
                </div>
                <!-- End .product-body -->
            </div>
            <!-- End .product -->

            <div class="product product-7 text-center">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="assets/images/products/product-7.jpg" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div>
                    <!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                    <!-- End .product-action -->
                </figure>
                <!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Jeans</a>
                    </div>
                    <!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">Blue utility pinafore denim dress</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        $76.00
                    </div>
                    <!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div>
                            <!-- End .ratings-val -->
                        </div>
                        <!-- End .ratings -->
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div>
                    <!-- End .rating-container -->
                </div>
                <!-- End .product-body -->
            </div>
            <!-- End .product -->
        </div> --}}
        <!-- End .owl-carousel -->
    </div>
    <!-- End .container -->
</div>
<!-- End .page-content -->

@endsection

@section('script')
<script>
    function check(kuantitas) {
        div.addEventListener('click', function () {});
        var max = kuantitas.getAttribute("data-max");
        if (parseInt(kuantitas.value) > parseInt(max)) {
            alert("Amount out of max!");
        }
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $("#kuantitas")
    // 	.attr("data-max", 20)
    // 	.val(1);

    $("#tampilHarga").change(function () {
        var ukuran = $(this).val();
        var produk_id = $(this).attr("produk-id");
        var data_max = $(this).attr('max');
        var berat = $(this).attr('value');

        if (ukuran == "") {
            alert("Mohon Pilih Ukuran");
            return false;
        }

        $.ajax({
            url: '/tampilProdukStok',
            data: {
                berat: berat,
                ukuran: ukuran,
                produk_id: produk_id
            },
            type: 'post',
            success: function (resp) {
                $(".tampilAtributStok").html(resp);
                $('#kuantitas').attr("max", resp).val(1);
            },
            error: function () {
                alert("error");
            }
        });

        $.ajax({
            url: '/tampilBerat',
            data: {
                berat: berat,
                ukuran: ukuran,
                produk_id: produk_id
            },
            type: 'post',
            success: function (resp) {
                $('.tampilBerat').attr("value", resp).val(resp);
            },
            error: function () {
                alert("error");
            }
        });

        // $.ajax({
        // 	url: '/tampilProdukHarga',
        // 	data:{ukuran:ukuran, produk_id:produk_id},
        // 	type:'post',
        // 	success:function(resp){
        // 		// alert(resp);
        // 		$(".tampilAtributHarga").html("Rp. "+resp);
        // 	}, error:function(){
        // 		alert("error");
        // 	}
        // });
    });

</script>
@endsection
