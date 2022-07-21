@extends('Frontend.Layouts.master', ['title'=>'Profile'])

@section('konten')
	<section class="content">
	<div class="container-fluid">
		<div class="row">
		<div class="col-md-3">

			<!-- Profile Image -->
			<div class="card card-primary card-outline" style="box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2); padding: 1.25rem; min-height: 1px;">
			<div class="card-body box-profile">
				<div class="text-center">
				{{-- <img class="profile-user-img img-fluid img-circle"
						src="../../dist/img/user4-128x128.jpg"
						alt="User profile picture"> --}}
				</div>

				<h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

				<p class="text-muted text-center">Pelanggan</p>

				<ul class="list-group list-group-unbordered mb-3">
				<li class="list-group-item">
					<b>Alamat</b> <a class="float-right">{{ $alamat_detail->alamat }}</a>
				</li>
				<li class="list-group-item">
					<b>Provinsi</b> <a class="float-right">{{ $alamat_detail->provinsi->name }}</a>
				</li>
				<li class="list-group-item">
					<b>Kota</b> <a class="float-right">{{ $alamat_detail->kota->name }}</a>
				</li>
				<li class="list-group-item">
					<b>Email</b> <a class="float-right">{{ Auth::user()->email }}</a>
				</li>
				</ul>
					<!-- Modal -->
					<div class="modal fade" id="ubahDataPelanggan" tabindex="-1" aria-labelledby="ubahDataPelangganLabel" aria-hidden="true">
						<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							</div>
							<div class="modal-body">
									<div class="form-box">
										<div class="form-tab">
											<ul class="nav nav-pills nav-fill" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Ubah Informasi Profil</a>
												</li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
													<form class="form-stl" action="{{route('UbahDataPelanggan', Auth::user()->id)}}" method="POST">
														@csrf
														@method('PUT')
														<div class="form-group">
															<label for="singin-email-2">Nama Lengkap</label>
															<input type="text" id="frm-reg-lname" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}"required>
															<span class ="text-danger">@error('name') {{$message}} @enderror</span>
														</div>
														<div class="form-group">
															<label for="singin-password-2">Alamat</label>
															<input type="text" id="frm-reg-email" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ $alamat_detail->alamat }}" required>
															<span class ="text-danger">@error('alamat') {{$message}} @enderror</span>
														</div>
														<div class="form-group">
															<label for="singin-password-2">Provinsi</label>
															<select class="form-control provinsi" name="provinsi_id" aria-hidden="true" required>
																<option value="0" required>-- Pilih Provinsi --</option>
																@foreach ($provinsi as $provinsis => $value)
																	@if ($alamat_detail->provinsi_id == $provinsis)
																	<option value="{{ $provinsis  }}" selected>{{ $value }}</option>
																	@else
																	<option value="{{ $provinsis  }}">{{ $value }}</option>
																	@endif
																@endforeach
															</select>
														</div>	
														<div class="form-group">
															<label for="singin-password-2">Kota</label>
															<select class="form-control kota" name="kota_id" aria-hidden="true" required>
																<option value="" required>-- Pilih Kota --</option>
															</select>
														</div>	
														<div class="form-group">
															<label for="singin-password-2">Nomor Hp</label>
															<input type="text" id="frm-reg-email" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror" value="{{  $alamat_detail->nomor_hp }}" required>
															<span class ="text-danger">@error('nomor_hp') {{$message}} @enderror</span>
														</div>
														<div class="form-group">
															<label for="singin-password-2">Email</label>
															<input type="email" id="frm-reg-email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}" required>
															<span class ="text-danger">@error('email') {{$message}} @enderror</span>
														</div>
														<div class="form-group">
															<label for="singin-password-2">Password *</label>
															<input type="password" id="frm-reg-pass" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Biarkan kosong jika tidak ingin diganti">
															<span class ="text-danger">@error('password') {{$message}} @enderror</span>
														</div>
						
														<div class="form-footer">
															<button type="submit" class="btn btn-outline-primary-2">
																<span>Setuju</span>
																<i class="icon-long-arrow-right"></i>
															</button>
														</div><!-- End .form-footer -->
													</form>
												</div><!-- .End .tab-pane -->
											</div><!-- End .tab-content -->
										</div><!-- End .form-tab -->
									</div><!-- End .form-box -->
							</div>
						</div>
						</div>
					</div>
				<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#ubahDataPelanggan"><b>Edit Profil</b></a>
			</div>
			<!-- /.card-body -->
			</div>
			<!-- /.card -->

		</div>
		<!-- /.col -->
		<div class="col-md-9">
			<div class="card" style="box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2); padding: 1.25rem; min-height: 1px; word-wrap: break-word;">
			<div class="card-header p-2" style="background-color: transparent;border-bottom: 1px solid rgba(0,0,0,.125);padding: .75rem 1.25rem;position: relative;border-top-left-radius: .25rem;border-top-right-radius: .25rem;">
				<ul class="nav nav-pills" style="justify-content: space-around;">
				<li class="nav-item"><a class="nav-link active" href="#pesanan" data-toggle="tab">Pesanan</a></li>
				<li class="nav-item"><a class="nav-link" href="#dikemas" data-toggle="tab">Dikemas</a></li>
				<li class="nav-item"><a class="nav-link" href="#dikirim" data-toggle="tab">Dikirim</a></li>
				<li class="nav-item"><a class="nav-link" href="#terkirim" data-toggle="tab">Selesai</a></li>
				<li class="nav-item"><a class="nav-link" href="#penilaian" data-toggle="tab">Beri Penilaian</a></li>
				</ul>
			</div><!-- /.card-header -->

			<div class="card">
				<div class="tab-content">
					@include('Frontend.Profile.pesanan')
					@include('Frontend.Profile.dikemas')
					@include('Frontend.Profile.dikirim')
					@include('Frontend.Profile.terkirim')
					@include('Frontend.Profile.penilaian')
				</div>
				</div>
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
	</section>
</main>
<!--main area-->
@endsection

@section('script')
	<script>

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