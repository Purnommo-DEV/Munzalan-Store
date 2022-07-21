@extends('Frontend.Layouts.master', ['title'=>'Semua Produk'])

@section('konten')
@php
    use App\Models\Produk;
@endphp

<div class="page-header text-center" style="background-image: url({{asset('gambar/gambar_slider')}}/{{ $data_slider->gambar }});">
    {{-- <div class="container">
        <h1 class="page-title">Semua Produk</h1>
    </div> --}}
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('HalamanBeranda') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('HalamanBelanja') }}">Semua Produk</a></li>

        </ol>
    </div>
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="toolbox">
                    @if(Session::has('error_message'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error_message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif(Session::has('success_message'))
                    <div class="alert alert-info" role="alert">
                        {{Session::get('success_message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="toolbox-right">
                        <form name="urutanProduk" id="urutanProduk" method="get" action="{{ route('HalamanBelanja') }}">
                        <div class="toolbox-sort">
                            <label for="sortby">Urutkan Berdasarkan :</label>
                            <div class="select-custom">
                                <select name="urutan" id="urutan" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="produk_terbaru" @if(isset($_GET['urutan'])&& $_GET['urutan']=="")selected="" @endif>Semua</option>
                                    <option value="produk_terbaru" @if(isset($_GET['urutan'])&& $_GET['urutan']=="produk_terbaru")selected="" @endif>Produk Terbaru</option>
                                    <option value="produk_a_z" @if(isset($_GET['urutan'])&& $_GET['urutan']=="produk_a_z")selected="" @endif>Produk A-Z</option>
                                    <option value="produk_harga_rendah" @if(isset($_GET['urutan'])&& $_GET['urutan']=="produk_harga_rendah")selected="" @endif>Produk Harga Terendah</option>
                                    <option value="produk_harga_tinggi"@if(isset($_GET['urutan'])&& $_GET['urutan']=="produk_harga_tinggi")selected="" @endif>Produk Harga Tertinggi</option>
                                </select>
                            </div>
                        </div>
                        </form>
                        {{-- <div class="toolbox-layout">
                            <a href="category-list.html" class="btn-layout">
                                <svg width="16" height="10">
                                    <rect x="0" y="0" width="4" height="4" />
                                    <rect x="6" y="0" width="10" height="4" />
                                    <rect x="0" y="6" width="4" height="4" />
                                    <rect x="6" y="6" width="10" height="4" />
                                </svg>
                            </a>

                            <a href="category-2cols.html" class="btn-layout">
                                <svg width="10" height="10">
                                    <rect x="0" y="0" width="4" height="4" />
                                    <rect x="6" y="0" width="4" height="4" />
                                    <rect x="0" y="6" width="4" height="4" />
                                    <rect x="6" y="6" width="4" height="4" />
                                </svg>
                            </a>

                            <a href="category.html" class="btn-layout active">
                                <svg width="16" height="10">
                                    <rect x="0" y="0" width="4" height="4" />
                                    <rect x="6" y="0" width="4" height="4" />
                                    <rect x="12" y="0" width="4" height="4" />
                                    <rect x="0" y="6" width="4" height="4" />
                                    <rect x="6" y="6" width="4" height="4" />
                                    <rect x="12" y="6" width="4" height="4" />
                                </svg>
                            </a>

                            <a href="category-4cols.html" class="btn-layout">
                                <svg width="22" height="10">
                                    <rect x="0" y="0" width="4" height="4" />
                                    <rect x="6" y="0" width="4" height="4" />
                                    <rect x="12" y="0" width="4" height="4" />
                                    <rect x="18" y="0" width="4" height="4" />
                                    <rect x="0" y="6" width="4" height="4" />
                                    <rect x="6" y="6" width="4" height="4" />
                                    <rect x="12" y="6" width="4" height="4" />
                                    <rect x="18" y="6" width="4" height="4" />
                                </svg>
                            </a>
                        </div><!-- End .toolbox-layout --> --}}
                    </div><!-- End .toolbox-right -->
                </div><!-- End .toolbox -->

                <div class="products mb-3" id="listProduk">
                    @include('Frontend.Belanja.list_produk')
                </div>
            </div><!-- End .col-lg-9 -->

            <aside class="col-lg-3 order-lg-first">
                <div class="sidebar sidebar-shop">
                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                Kategori
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-1">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    @foreach ($kategori as $kategoris)
                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input cek" value="{{ $kategoris->id }}" id="cat-{{ $kategoris->id }}">
                                            <label class="custom-control-label" for="cat-{{ $kategoris->id }}">{{ $kategoris->name }}</label>
                                        </div><!-- End .custom-checkbox -->
                                        <span class="item-count">({{ App\Models\Produk::where('kategori_id', $kategoris->id)->count() }})</span>
                                    </div>                                        
                                    @endforeach
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    {{-- <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                Colour
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-3">
                            <div class="widget-body">
                                <div class="filter-colors">
                                    <a href="#" style="background: #b87145;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #f0c04a;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #333333;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" class="selected" style="background: #cc3333;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #3399cc;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #669933;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #f2719c;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #ebebeb;"><span class="sr-only">Color Name</span></a>
                                </div><!-- End .filter-colors -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div>--}}

                    {{-- <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                Brand
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-4">
                            <div class="widget-body">
                                <div class="filter-items">
                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-1">
                                            <label class="custom-control-label" for="brand-1">Next</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-2">
                                            <label class="custom-control-label" for="brand-2">River Island</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-3">
                                            <label class="custom-control-label" for="brand-3">Geox</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-4">
                                            <label class="custom-control-label" for="brand-4">New Balance</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-5">
                                            <label class="custom-control-label" for="brand-5">UGG</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-6">
                                            <label class="custom-control-label" for="brand-6">F&F</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-7">
                                            <label class="custom-control-label" for="brand-7">Nike</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget --> --}}
                </div><!-- End .sidebar sidebar-shop -->
            </aside>
            
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .page-content -->

@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#urutan").on('change', function(){
            var urutan = $(this).val();
            $.ajax({
                method:"get",
                dataType:'html',
                url:'{{ url('/belanjaFilter') }}',
                data:{urutan:urutan},
                success:function(data){
                    $('#listProduk').html(data);
                }
            })
        });
    
        $('.cek').click(function(){
            var kategori = [];
            $('.cek').each(function(){
                    if($(this).is(":checked")){
                        kategori.push($(this).val());
                    }
                });
            cekKategori = kategori.toString();
            // console.log(cekKategori);

            $.ajax({
                type: 'get',
                dataType: 'html',
                url:'{{ url('/filterKategori') }}',
                data:"kategori=" + cekKategori,
                success:function(response){
                    console.log(response);
                    $('#listProduk').html(response);
                }
            });
        });

        // $("#slider-range").slider(({
        //     range: true,
        //     min: 0,
        //     max:100,
        //     values:[15,65],
        //     slide: function(event, ui){
        //         $("#amount_start").val(ui.values[0]);
        //         $("#amount_end").val(ui.values[1]);
        //         var start = $('#amount_start').val();
        //         var end = $('#amount_end').val();

        //         $.ajax({
        //             type:'get',
        //             dataType: 'html',
        //             url: '',
        //             data: "start="+start+"& end="+end,
        //             success:function(response){
        //                 console.log(response);
        //                 $("#listProduk").html(response);
        //             }
        //         })
        //     }
        // }))
    });

</script>
@endsection