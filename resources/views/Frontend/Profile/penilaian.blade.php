<div class="tab-pane" id="penilaian">
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="products mb-3">
                        @foreach ($pesanan as $pesanans)
                        @if($pesanans->status_pesanan == "Pesanan Di Terima")
                        <button type="button" class="btn btn-block btn-danger btn-xs">Kode Pesanan :
                            {{$pesanans->id}}</button>
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
                                            <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduks->gambar1 }}"
                                                alt="Product image" class="product-image">
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

                                        {{-- @if (!$penilaian->pesanana_id == $pesanans->id && $penilaian->produk_id == $produkDiPesans->produk_id)
                                        <a href="#" class="btn-product btn-cart" style="background-color: white;color;color: #3b025b;border-color: #3b025b;">
                                            Lihat Penilaian
                                        </a> 
                                        @else --}}
                                        @if ($produkDiPesans->status_penilaian == 1 )
                                            <a href="#" class="btn-product btn-cart" style="background-color: white;color;color: #3b025b;border-color: #3b025b;">
                                                Telah Dinilai
                                            </a>
                                        @else
                                        <a href="#" data-toggle="modal"
                                            data-target="#nilaiProduk-{{ $produkDiPesans->id}}" class="btn-product btn-cart"
                                            style="background-color: white;color;color: #3b025b;border-color: #3b025b;"> Nilai
                                        </a>
                                        @endif
                                            
                                        
                                        <?php
                                            $idProdukDiPesan = $produkDiPesans->id
                                        ?>

                                        <form action="{{ route('Penilaian') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal fade" id="nilaiProduk-{{ $produkDiPesans->id}}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        <input type="hidden" name="produk_pesanan_id" value="{{ $produkDiPesans->id }}">
                                                        <input type="hidden" name="produk_id" value="{{ $produkDiPesans->produk_id }}">
                                                        <div class="modal-body">
                                                            <div class="row justify-content-center">
                                                                <div class="col-12">
                                                                    <div class="product product-7 text-center">
                                                                        <figure class="product-media">
                                                                            <a href="product.html">
                                                                                {{-- <img src="" id="preview" class="product-image"> --}}
                                                                            </a>
                                                                        </figure>
                                                                        <div class="product-body">
                                                                            <div class="product-cat">
                                                                                <input type="file" name="gambar" class="form-control" accept="image/*">
                                                                            </div>
                                                                            <span class="ratings-text"><strong>Beri Rating</strong></span>
                                                                            <div class="ratings-container">
                                                                                <div class="comment-form-rating">
                                                                                    <p class="stars">
                                                                                        <label for="rated-1{{ $produkDiPesans->id }}" class="icon-star-o"></label>
                                                                                        <input type="radio" id="rated-1{{ $produkDiPesans->id }}" name="bintang" value="1">
                                                                                        <label for="rated-2{{ $produkDiPesans->id }}" class="icon-star-o"></label>
                                                                                        <input type="radio" id="rated-2{{ $produkDiPesans->id }}" name="bintang" value="2">
                                                                                        <label for="rated-3{{ $produkDiPesans->id }}" class="icon-star-o"></label>
                                                                                        <input type="radio" id="rated-3{{ $produkDiPesans->id }}" name="bintang" value="3">
                                                                                        <label for="rated-4{{ $produkDiPesans->id }}" class="icon-star-o"></label>
                                                                                        <input type="radio" id="rated-4{{ $produkDiPesans->id }}" name="bintang" value="4">
                                                                                        <label for="rated-5{{ $produkDiPesans->id }}" class="icon-star-o"></label>
                                                                                        <input type="radio" id="rated-5{{ $produkDiPesans->id }}" name="bintang" value="5" checked="checked">
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" name="komentar" cols="30" rows="4" required placeholder="Komentar"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Setuju</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End .product-list-action -->
                                </div><!-- End .col-sm-6 col-lg-3 -->
                            </form>

                                <div class="col-lg-6">
                                    <div class="product-body product-action-inner">
                                        {{-- <a href="#" class="btn-product btn-wishlist" title="Add to wishlist"><span>add to wishlist</span></a> --}}
                                        {{-- <div class="product-cat">
                                                <a href="#">x{{ $produkDiPesans->kuantitas }}</a>
                                    </div><!-- End .product-cat --> --}}
                                    <h3 class="product-title"><a
                                            href="product.html">{{ $produkDiPesans->nama_produk }}</a></h3>
                                    <!-- End .product-title -->

                                    <div class="product-content">
                                        <p>{{ $produkDiPesans->produk->deskripsi_singkat }}</p>
                                    </div><!-- End .product-content -->

                                    <div class="product-nav product-nav-thumbs">
                                        @foreach ($gambarProduk as $gambarProduks)
                                        @if ($produkDiPesans->produk->id == $gambarProduks->produk_id)
                                        <a href="#" class="active">
                                            <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduks->gambar2 }}"
                                                alt="product desc">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduks->gambar3 }}"
                                                alt="product desc">
                                        </a>

                                        <a href="#">
                                            <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduks->gambar4 }}"
                                                alt="product desc">
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
@section('script')
<script>
    // $(document).on("click", ".browse", function() {
    //     var file = $(this).parents().find(".file");
    //     file.trigger("click");
    // });
//     $('input[type="file"]').change(function(e) {
//         var fileName = e.target.files[0].name;
//         $("#file").val(fileName);

//         var reader = new FileReader();
//         reader.onload = function(e) {
//             // get loaded data and render thumbnail.
//             document.getElementById("preview").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });
</script>
@endsection