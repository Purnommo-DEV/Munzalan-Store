@extends('Frontend.Layouts.master')

@section('konten')
<main id="main" class="main-site">

<div class="container">


	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title">Shopping Cart<span>Shop</span></h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Shop</a></li>
				<li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
			</ol>
		</div><!-- End .container -->
	</nav><!-- End .breadcrumb-nav -->

	<div class="page-content">

    <div id="GabungKeranjang">
        @include('Frontend.Keranjang.isiKeranjang')
    </div>
	
        <div class="wrap-show-advance-info-box style-1 box-in-site">
            <h3 class="title-box">Most Viewed Products</h3>
            <div class="wrap-products">
                <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item new-label">new</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>
                </div>
            </div><!--End wrap-products-->
        </div>

    </div><!--end main content area-->
</div><!--end container-->

</main>
@endsection

@section('script')
	<script>
		// tampilJumlahDataKeranjang();
		
		// function tampilJumlahDataKeranjang() {
		// 	$.ajax({
		// 		method: "GET",
		// 		url: "/hitung_total_barang_keranjang",
		// 		success: function (response) {
		// 			$('.totalBarangKeranjangClass').html('');
		// 			$('.totalBarangKeranjangClass').html(response.totalBarangKeranjangs);
		// 		}
		// 	});
		// }
		
		function check(kuantitas) {
			div.addEventListener('click', function () { });
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
	
		$("#tampilHarga").change(function(){
			var ukuran = $(this).val();
			var produk_id = $(this).attr("produk-id");
			var data_max = $(this).attr('data-max');
			if (ukuran==""){
				alert("Mohon Pilih Ukuran");
				return false;
			}
			$.ajax({
				url: '/tampilProdukHarga',
				data:{ukuran:ukuran, produk_id:produk_id},
				type:'post',
				success:function(resp){
					// alert(resp);
					$(".tampilAtributHarga").html("Rp. "+resp);
				}, error:function(){
					alert("error");
				}
			});

			$.ajax({
				url: '/tampilProdukStok',
				data:{ukuran:ukuran, produk_id:produk_id},
				type:'post',
				success:function(resp){
					// alert(resp);
					$(".tampilAtributStok").html(resp);
					$('#kuantitas').attr("data-max", resp).val(1);
				}, error:function(){
					alert("error");
				}
			});
		});

        $(document).on('click','.btnItemUpdate', function(){
            if($(this).hasClass('qtyMinus')){
                var kuantitas = $(this).prev().val();
                if(kuantitas<=1){
                    alert("Tidak Bisa 0");
                    return false;
                }else{
					kuantitas_baru = parseInt(kuantitas)-1;
				}
            }
			if($(this).hasClass('qtyPlus')){
                var kuantitas = $(this).prev().prev().val();
                    kuantitas_baru = parseInt(kuantitas)+1;
            }
			var cartid = $(this).data('cartid'); 
			$.ajax({
				data:{
					"cartid":cartid,
					"kts":kuantitas_baru
				},
				url:'/updateKuantitasKeranjang',
				type:'post',
				success:function(resp){
					// alert(resp);
					// alert(resp.status);
					if(resp.status==false){
						alert("Melebihi Stok");
					}
					$("#GabungKeranjang").html(resp.view);
				},
				error:function(){
					alert("Update Kuantitas Gagal");
				}
			});
        });

		$(document).on('click','.btnItemDelete', function(){
			var cartid = $(this).data('cartid');
			var peringatan = confirm("Yakin Ingin Menghapus?");
			if(peringatan){
					$.ajax({
					data:{ "cartid":cartid, },
					url:'/deleteBarangKeranjang',
					type:'post',
					success:function(resp){
						$(".totalBarangKeranjangClass").html(resp.AmbilDataTotalBarangKeranjang);
						$("#GabungKeranjang").html(resp.view);
					},
					error:function(){
						alert("error");
					}
				});
			}
			// Cek apakah sesuai dengan data yang di Pilih
				// alert(cartid); return false;
        });
	</script>
@endsection