@extends('Frontend.Layouts.master', ['title'=>'Keranjang'])

@section('konten')


    <div id="GabungKeranjang">
        @include('Frontend.Keranjang.isiKeranjang')
    </div>
        
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
        });
	</script>

	
@endsection