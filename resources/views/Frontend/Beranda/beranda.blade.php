@extends('Frontend.Layouts.master', ['title'=>'Munzalan Store'])

@section('konten')
@php
use App\Models\Produk;
@endphp
<div class="intro-slider-container mb-4">
    <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
            "nav": false, 
            "dots": true,
            "responsive": {
                "992": {
                    "nav": true,
                    "dots": false
                }
            }
        }'>
        @foreach ($data_slider as $data_slider)
        <div class="intro-slide"
            style="background-image: url({{asset('gambar/gambar_slider')}}/{{ $data_slider->gambar }});">
            <div class="container intro-content">
                {{-- <h3 class="intro-subtitle text-primary">SEASONAL PICKS</h3> --}}
                <h1 class="intro-title">{!! $data_slider->teks!!}</h1>
                {{-- <a href="category.html" class="btn btn-outline-primary-2">
                    <span>DISCOVER MORE</span>
                    <i class="icon-long-arrow-right"></i>
                </a> --}}
            </div>
        </div>
        @endforeach
        <!-- End .intro-slide -->

        {{-- <div class="intro-slide"
            style="background-image: url({{asset('frontend/images/demos/demo-11/slider/slide-2.jpg')}});">
            <div class="container intro-content">
                <h3 class="intro-subtitle text-primary">all at 50% off</h3>
                <!-- End .h3 intro-subtitle -->
                <h1 class="intro-title text-white">The Most Beautiful <br>Novelties In Our Shop</h1>
                <!-- End .intro-title -->

                <a href="category.html" class="btn btn-outline-primary-2 min-width-sm">
                    <span>SHOP NOW</span>
                    <i class="icon-long-arrow-right"></i>
                </a>
            </div>
            <!-- End .intro-content -->
        </div> --}}
        <!-- End .intro-slide -->
    </div>
    <!-- End .intro-slider owl-carousel owl-simple -->

    <span class="slider-loader"></span>
    <!-- End .slider-loader -->
</div>

<div class="mb-4"></div>
<!-- End .mb-2 -->

<div class="container">
    <h2 class="title text-center mb-2">Kategori</h2>
    <!-- End .title -->
    {{-- Kategori --}}
    <div class="cat-blocks-container">
        <div class="row">

            @foreach ($kategori as $kategoris)
            <div class="col-6 col-sm-4 col-lg-2">
                <a href="category.html" class="cat-block">
                    <figure>
                        <span>
                            <img src="{{ asset('gambar/gambar_kategori')}}/{{ $kategoris->gambar }}"
                                alt="Category image">
                        </span>
                    </figure>

                    <h3 class="cat-block-title">{{ $kategoris->name }}</h3>
                    <!-- End .cat-block-title -->
                </a>
            </div>
            <!-- End .col-sm-4 col-lg-2 -->
            @endforeach
        </div>
        <!-- End .row -->
    </div>
    {{-- Akhir Kategori --}}
    <!-- End .cat-blocks-container -->
</div>
<!-- End .container -->

<div class="mb-2"></div>
<!-- End .mb-2 -->

<div class="container">
    <div class="row">

        @foreach ($data_iklan as $data_iklan)
        <div class="col-lg-6">
            <div class="banner banner-overlay banner-overlay-light">
                <a href="#">
                    <img src="{{asset('gambar/gambar_iklan')}}/{{ $data_iklan->gambar }}" alt="Banner">
                </a>

                <div class="banner-content">
                    {{-- <h4 class="banner-subtitle d-none d-sm-block"><a href="#">Spring Sale is Coming</a></h4> --}}
                    <!-- End .banner-subtitle -->
                    <h3 class="banner-title"><a href="#">{!!$data_iklan->teks !!}
                        {{-- <span class="text-primary">15% off</span> --}}
                    </a>
                    </h3>
                    <!-- End .banner-title -->
                    {{-- <a href="#" class="banner-link banner-link-dark">Discover Now <i
                            class="icon-long-arrow-right"></i></a> --}}
                </div>
                <!-- End .banner-content -->
            </div>
            <!-- End .banner -->
        </div>
        @endforeach
        <!-- End .col-lg-6 -->
        {{-- <div class="col-sm-6 col-lg-3">
            <div class="banner banner-overlay">
                <a href="#">
                    <img src="{{asset('frontend/assets/images/demos/demo-13/banners/banner-1.jpg')}}" alt="Banner">
                </a>

                <div class="banner-content">
                    <h4 class="banner-subtitle text-white"><a href="#">Weekend Sale</a></h4>
                    <!-- End .banner-subtitle -->
                    <h3 class="banner-title text-white"><a href="#">Lighting <br>& Accessories <br><span>25%
                                off</span></a></h3>
                    <!-- End .banner-title -->
                    <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                </div>
                <!-- End .banner-content -->
            </div>
            <!-- End .banner -->
        </div>
        <!-- End .col-lg-3 -->

        <div class="col-sm-6 col-lg-3 order-lg-last">
            <div class="banner banner-overlay">
                <a href="#">
                    <img src="{{asset('frontend/assets/images/demos/demo-13/banners/banner-3.jpg')}}" alt="Banner">
                </a>

                <div class="banner-content">
                    <h4 class="banner-subtitle text-white"><a href="#">Smart Offer</a></h4>
                    <!-- End .banner-subtitle -->
                    <h3 class="banner-title text-white"><a href="#">Anniversary <br>Special <br><span>15% off</span></a>
                    </h3>
                    <!-- End .banner-title -->
                    <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                </div>
                <!-- End .banner-content -->
            </div>
            <!-- End .banner -->
        </div>
        <!-- End .col-lg-3 -->

        <div class="col-lg-6">
            <div class="banner banner-overlay">
                <a href="#">
                    <img src="{{asset('frontend/assets/images/demos/demo-13/banners/banner-2.jpg')}}" alt="Banner">
                </a>

                <div class="banner-content">
                    <h4 class="banner-subtitle text-white d-none d-sm-block"><a href="#">Amazing Value</a></h4>
                    <!-- End .banner-subtitle -->
                    <h3 class="banner-title text-white"><a href="#">Clothes Trending <br>Spring Collection 2019
                            <br><span>from $12,99</span></a></h3>
                    <!-- End .banner-title -->
                    <a href="#" class="banner-link">Discover Now <i class="icon-long-arrow-right"></i></a>
                </div>
                <!-- End .banner-content -->
            </div>
            <!-- End .banner -->
        </div>
        <!-- End .col-lg-6 --> --}}
    </div>
    <!-- End .row -->
</div>
<!-- End .container -->

<div class="mb-3"></div>
<!-- End .mb-3 -->

<div class="container furniture">
    <div class="heading heading-flex heading-border mb-3">
        <div class="heading-left">
            <h2 class="title">Produk</h2>
            <!-- End .title -->
        </div>
        {{-- <div class="heading-right">
            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="furn-new-link" data-toggle="tab" href="#furn-new-tab" role="tab"
                        aria-controls="furn-new-tab" aria-selected="true">New</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="furn-featured-link" data-toggle="tab" href="#furn-featured-tab" role="tab"
                        aria-controls="furn-featured-tab" aria-selected="false">Featured</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="furn-best-link" data-toggle="tab" href="#furn-best-tab" role="tab"
                        aria-controls="furn-best-tab" aria-selected="false">Best Seller</a>
                </li>
            </ul>
        </div> --}}
    </div>
    <!-- End .heading -->

    <div class="tab-content tab-content-carousel">
        <div class="tab-pane p-0 fade show active" id="furn-new-tab" role="tabpanel" aria-labelledby="furn-new-link">
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
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
                            "1280": {
                                "items":5,
                                "nav": true
                            }
                        }
                    }'>
                @foreach ($data_produk as $data_produks)
                    <div class="product produk-data">
                        <figure class="product-media">
                            {{-- <span class="product-label label-new">New</span> --}}
                            <a href="{{route('HalamanDetailProduk',$data_produks->slug)}}">
                                @foreach ($gambar_produk as $gambar_produks)
                                @if ($data_produks->id == $gambar_produks->produk_id)
                                <img src="{{asset('gambar/gambar_produk')}}/{{$gambar_produks->gambar1}}"
                                    alt="{{$data_produks->name}}" class="product-image">
                                @endif
                                @endforeach
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                        wishlist</span></a>
                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                    title="Quick view"><span>Quick view</span></a>
                            </div>
                            <!-- End .product-action-vertical -->

                            <div class="product-action">
                                <input type="hidden" class="produk_id" value="{{$data_produks->id}}">
                                <a href="#" class="btn-product btn-wishlist tambahKeFaforitBtn" title="Tambah Ke Favorit"><span>Tambah Favorit</span></a>
                                <a href="{{route('HalamanDetailProduk',$data_produks->slug)}}"
                                    class="btn-product btn-quickview" title="Lihat Detail"><span>Lihat Detail</span></a>
                            </div><!-- End .product-action -->
                            <!-- End .product-action -->
                        </figure>
                        <!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="#">{{$data_produks->kategori->name}}</a>
                            </div>
                            <!-- End .product-cat -->
                            <h3 class="product-title"><a href="product.html">{{$data_produks->name}}</a></h3>
                            <!-- End .product-title -->
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
                            <!-- End .product-price -->
                            <div class="ratings-container">
                                @if (App\Models\Penilaian::where('produk_id',$data_produks->id)->first())
                                @php
                                $statusPenilaianProduk = App\Models\PesananProduk::where('produk_id',
                                $data_produks->id)->where('status_penilaian',1)->get();
                                $rating = App\Models\Penilaian::where('produk_id',$data_produks->id)->avg('bintang');
                                $avgRating = number_format($rating,1);
                                @endphp
                                <?php $star = 1;
                                            while($star <= $avgRating){ ?>
                                <label for="rating2" class="icon-star-o" style="color:orange;"></label>
                                <?php $star++; } ?>

                                <label class="ratings-text" style="color:chocolate">({{$avgRating}})</label>
                                <label class="ratings-text" style="color:chocolate">({{count($statusPenilaianProduk)}})
                                    Review</label>
                                @else
                                <label class="text-danger">Belum Ada Review</label>
                                @endif
                            </div>
                        </div>
                        <!-- End .product-body -->
                    </div>
                @endforeach
            </div>
            <!-- End .owl-carousel -->
        </div>
        <!-- .End .tab-pane -->
        {{-- <div class="tab-pane p-0 fade" id="furn-featured-tab" role="tabpanel" aria-labelledby="furn-featured-link">
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
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
                            "1280": {
                                "items":5,
                                "nav": true
                            }
                        }
                    }'>
                <div class="product">
                    <figure class="product-media">
                        <span class="product-label label-sale">Sale</span>
                        <a href="product.html">
                            <img src="{{asset('frontend/assets/images/demos/demo-13/products/product-13.jpg')}}"
                                alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                        </div>
                        <!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                        </div>
                        <!-- End .product-action -->
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Lighting</a>
                        </div>
                        <!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Carronade Large Suspension Lamp</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            <span class="new-price">$892.00</span>
                            <span class="old-price">Was $939.00</span>
                        </div>
                        <!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 60%;"></div>
                                <!-- End .ratings-val -->
                            </div>
                            <!-- End .ratings -->
                            <span class="ratings-text">( 6 Reviews )</span>
                        </div>
                        <!-- End .rating-container -->

                        <div class="product-nav product-nav-dots">
                            <a href="#" class="active" style="background: #dddad5;"><span class="sr-only">Color
                                    name</span></a>
                            <a href="#" style="background: #825a45;"><span class="sr-only">Color name</span></a>
                        </div>
                        <!-- End .product-nav -->
                    </div>
                    <!-- End .product-body -->
                </div>
                <!-- End .product -->

                <div class="product">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="{{asset('frontend/assets/images/demos/demo-13/products/product-14.jpg')}}"
                                alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                        </div>
                        <!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                        </div>
                        <!-- End .product-action -->
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Chairs</a>
                        </div>
                        <!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Wingback Chair</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            $210.00
                        </div>
                        <!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 40%;"></div>
                                <!-- End .ratings-val -->
                            </div>
                            <!-- End .ratings -->
                            <span class="ratings-text">( 4 Reviews )</span>
                        </div>
                        <!-- End .rating-container -->

                        <div class="product-nav product-nav-dots">
                            <a href="#" class="active" style="background: #999999;"><span class="sr-only">Color
                                    name</span></a>
                            <a href="#" style="background: #cc9999;"><span class="sr-only">Color name</span></a>
                        </div>
                        <!-- End .product-nav -->
                    </div>
                    <!-- End .product-body -->
                </div>
                <!-- End .product -->

                <div class="product">
                    <figure class="product-media">
                        <span class="product-label label-new">New</span>
                        <a href="product.html">
                            <img src="{{asset('frontend/assets/images/demos/demo-13/products/product-11.jpg')}}"
                                alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                        </div>
                        <!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                        </div>
                        <!-- End .product-action -->
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Tables</a>
                        </div>
                        <!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Block Side Table/Trolley</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            $229.00
                        </div>
                        <!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div>
                                <!-- End .ratings-val -->
                            </div>
                            <!-- End .ratings -->
                            <span class="ratings-text">( 12 Reviews )</span>
                        </div>
                        <!-- End .rating-container -->

                        <div class="product-nav product-nav-dots">
                            <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color
                                    name</span></a>
                            <a href="#" style="background: #e2e2e2;"><span class="sr-only">Color name</span></a>
                        </div>
                        <!-- End .product-nav -->
                    </div>
                    <!-- End .product-body -->
                </div>
                <!-- End .product -->

                <div class="product">
                    <figure class="product-media">
                        <span class="product-label label-sale">Sale</span>
                        <a href="product.html">
                            <img src="{{asset('frontend/assets/images/demos/demo-13/products/product-15.jpg')}}"
                                alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                        </div>
                        <!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                        </div>
                        <!-- End .product-action -->
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Chairs</a>
                        </div>
                        <!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Flow Slim Armchair</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            <span class="new-price">$737,00</span>
                            <span class="old-price">Was $820.00</span>
                        </div>
                        <!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div>
                                <!-- End .ratings-val -->
                            </div>
                            <!-- End .ratings -->
                            <span class="ratings-text">( 10 Reviews )</span>
                        </div>
                        <!-- End .rating-container -->

                        <div class="product-nav product-nav-dots">
                            <a href="#" class="active" style="background: #877666;"><span class="sr-only">Color
                                    name</span></a>
                            <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                        </div>
                        <!-- End .product-nav -->
                    </div>
                    <!-- End .product-body -->
                </div>
                <!-- End .product -->

                <div class="product">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="{{asset('frontend/assets/images/demos/demo-13/products/product-12.jpg')}}"
                                alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                        </div>
                        <!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                        </div>
                        <!-- End .product-action -->
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Sofas</a>
                        </div>
                        <!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Roots Sofa Bed</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            $1,199.99
                        </div>
                        <!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 100%;"></div>
                                <!-- End .ratings-val -->
                            </div>
                            <!-- End .ratings -->
                            <span class="ratings-text">( 4 Reviews )</span>
                        </div>
                        <!-- End .rating-container -->
                    </div>
                    <!-- End .product-body -->
                </div>
                <!-- End .product -->
            </div>
            <!-- End .owl-carousel -->
        </div>
        <!-- .End .tab-pane -->
        <div class="tab-pane p-0 fade" id="furn-best-tab" role="tabpanel" aria-labelledby="furn-best-link">
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
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
                            "1280": {
                                "items":5,
                                "nav": true
                            }
                        }
                    }'>
                <div class="product">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="{{asset('frontend/assets/images/demos/demo-13/products/product-12.jpg')}}"
                                alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                        </div>
                        <!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                        </div>
                        <!-- End .product-action -->
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Sofas</a>
                        </div>
                        <!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Roots Sofa Bed</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            $1,199.99
                        </div>
                        <!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 100%;"></div>
                                <!-- End .ratings-val -->
                            </div>
                            <!-- End .ratings -->
                            <span class="ratings-text">( 4 Reviews )</span>
                        </div>
                        <!-- End .rating-container -->
                    </div>
                    <!-- End .product-body -->
                </div>
                <!-- End .product -->

                <div class="product">
                    <figure class="product-media">
                        <span class="product-label label-sale">Sale</span>
                        <a href="product.html">
                            <img src="{{asset('frontend/assets/images/demos/demo-13/products/product-13.jpg')}}"
                                alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                        </div>
                        <!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                        </div>
                        <!-- End .product-action -->
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Lighting</a>
                        </div>
                        <!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Carronade Large Suspension Lamp</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            <span class="new-price">$892.00</span>
                            <span class="old-price">Was $939.00</span>
                        </div>
                        <!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 60%;"></div>
                                <!-- End .ratings-val -->
                            </div>
                            <!-- End .ratings -->
                            <span class="ratings-text">( 6 Reviews )</span>
                        </div>
                        <!-- End .rating-container -->

                        <div class="product-nav product-nav-dots">
                            <a href="#" class="active" style="background: #dddad5;"><span class="sr-only">Color
                                    name</span></a>
                            <a href="#" style="background: #825a45;"><span class="sr-only">Color name</span></a>
                        </div>
                        <!-- End .product-nav -->
                    </div>
                    <!-- End .product-body -->
                </div>
                <!-- End .product -->

                <div class="product">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="{{asset('frontend/assets/images/demos/demo-13/products/product-14.jpg')}}"
                                alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                        </div>
                        <!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                        </div>
                        <!-- End .product-action -->
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Chairs</a>
                        </div>
                        <!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Wingback Chair</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            $210.00
                        </div>
                        <!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 40%;"></div>
                                <!-- End .ratings-val -->
                            </div>
                            <!-- End .ratings -->
                            <span class="ratings-text">( 4 Reviews )</span>
                        </div>
                        <!-- End .rating-container -->

                        <div class="product-nav product-nav-dots">
                            <a href="#" class="active" style="background: #999999;"><span class="sr-only">Color
                                    name</span></a>
                            <a href="#" style="background: #cc9999;"><span class="sr-only">Color name</span></a>
                        </div>
                        <!-- End .product-nav -->
                    </div>
                    <!-- End .product-body -->
                </div>
                <!-- End .product -->

                <div class="product">
                    <figure class="product-media">
                        <span class="product-label label-sale">Sale</span>
                        <a href="product.html">
                            <img src="{{asset('frontend/assets/images/demos/demo-13/products/product-15.jpg')}}"
                                alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                        </div>
                        <!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                        </div>
                        <!-- End .product-action -->
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Chairs</a>
                        </div>
                        <!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Flow Slim Armchair</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            <span class="new-price">$737,00</span>
                            <span class="old-price">Was $820.00</span>
                        </div>
                        <!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div>
                                <!-- End .ratings-val -->
                            </div>
                            <!-- End .ratings -->
                            <span class="ratings-text">( 10 Reviews )</span>
                        </div>
                        <!-- End .rating-container -->

                        <div class="product-nav product-nav-dots">
                            <a href="#" class="active" style="background: #877666;"><span class="sr-only">Color
                                    name</span></a>
                            <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                        </div>
                        <!-- End .product-nav -->
                    </div>
                    <!-- End .product-body -->
                </div>
                <!-- End .product -->
            </div>
            <!-- End .owl-carousel -->
        </div> --}}
        <!-- .End .tab-pane -->
    </div>
    <!-- End .tab-content -->
</div>
<!-- End .container -->

<div class="mb-3"></div>
<!-- End .mb-3 -->

{{-- <div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="banner banner-overlay banner-overlay-light">
                <a href="#">
                    <img src="{{asset('frontend/assets/images/demos/demo-13/banners/banner-4.jpg')}}" alt="Banner">
                </a>

                <div class="banner-content">
                    <h4 class="banner-subtitle d-none d-sm-block"><a href="#">Spring Sale is Coming</a></h4>
                    <!-- End .banner-subtitle -->
                    <h3 class="banner-title"><a href="#">All Smart Watches <br>Discount <br><span
                                class="text-primary">15% off</span></a></h3>
                    <!-- End .banner-title -->
                    <a href="#" class="banner-link banner-link-dark">Discover Now <i
                            class="icon-long-arrow-right"></i></a>
                </div>
                <!-- End .banner-content -->
            </div>
            <!-- End .banner -->
        </div>
        <!-- End .col-lg-6 -->

        <div class="col-lg-6">
            <div class="banner banner-overlay">
                <a href="#">
                    <img src="{{asset('frontend/assets/images/demos/demo-13/banners/banner-5.png')}}" alt="Banner">
                </a>

                <div class="banner-content">
                    <h4 class="banner-subtitle text-white  d-none d-sm-block"><a href="#">Amazing Value</a></h4>
                    <!-- End .banner-subtitle -->
                    <h3 class="banner-title text-white"><a href="#">Headphones Trending <br>JBL Harman <br><span>from
                                $59,99</span></a></h3>
                    <!-- End .banner-title -->
                    <a href="#" class="banner-link">Discover Now <i class="icon-long-arrow-right"></i></a>
                </div>
                <!-- End .banner-content -->
            </div>
            <!-- End .banner -->
        </div>
        <!-- End .col-lg-6 -->
    </div>
    <!-- End .row -->
</div>
<!-- End .container --> --}}

{{-- <div class="mb-1"></div>
<!-- End .mb-1 -->

<div class="mb-3"></div>
<!-- End .mb-3 -->

<div class="container">
    <h2 class="title title-border mb-5">Shop by Brands</h2>
    <!-- End .title -->
    <div class="owl-carousel mb-5 owl-simple" data-toggle="owl" data-owl-options='{
                "nav": false, 
                "dots": true,
                "margin": 30,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":2
                    },
                    "420": {
                        "items":3
                    },
                    "600": {
                        "items":4
                    },
                    "900": {
                        "items":5
                    },
                    "1024": {
                        "items":6
                    },
                    "1280": {
                        "items":6,
                        "nav": true,
                        "dots": false
                    }
                }
            }'>
        <a href="#" class="brand">
            <img src="{{asset('frontend/assets/images/brands/1.png')}}" alt="Brand Name">
        </a>

        <a href="#" class="brand">
            <img src="{{asset('frontend/assets/images/brands/2.png')}}" alt="Brand Name">
        </a>

        <a href="#" class="brand">
            <img src="{{asset('frontend/assets/images/brands/3.png')}}" alt="Brand Name">
        </a>

        <a href="#" class="brand">
            <img src="{{asset('frontend/assets/images/brands/4.png')}}" alt="Brand Name">
        </a>

        <a href="#" class="brand">
            <img src="{{asset('frontend/assets/images/brands/5.png')}}" alt="Brand Name">
        </a>

        <a href="#" class="brand">
            <img src="{{asset('frontend/assets/images/brands/6.png')}}" alt="Brand Name">
        </a>

        <a href="#" class="brand">
            <img src="{{asset('frontend/assets/images/brands/7.png')}}" alt="Brand Name">
        </a>
    </div>
    <!-- End .owl-carousel -->
</div> --}}
<!-- End .container -->

{{-- <div class="cta cta-horizontal cta-horizontal-box bg-primary">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-2xl-5col">
                <h3 class="cta-title text-white">Join Our Newsletter</h3>
                <!-- End .cta-title -->
                <p class="cta-desc text-white">Subcribe to get information about products and coupons</p>
                <!-- End .cta-desc -->
            </div>
            <!-- End .col-lg-5 -->

            <div class="col-3xl-5col">
                <form action="#">
                    <div class="input-group">
                        <input type="email" class="form-control form-control-white"
                            placeholder="Enter your Email Address" aria-label="Email Adress" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-white-2" type="submit"><span>Subscribe</span><i
                                    class="icon-long-arrow-right"></i></button>
                        </div>
                        <!-- .End .input-group-append -->
                    </div>
                    <!-- .End .input-group -->
                </form>
            </div>
            <!-- End .col-lg-7 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->
</div> --}}
<!-- End .cta -->

@endsection
@section('script')

@endsection
