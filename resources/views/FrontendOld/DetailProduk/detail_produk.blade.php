@extends('Frontend.Layouts.master')
@section('konten')
@php
    use App\Models\Produk;
@endphp

    <main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>detail</span></li>
					<li class="item-link"><span>{{$detail_produk->id}}</span></li>
				</ul>
			</div>
			<div class="row">

				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
					<div class="wrap-product-detail">
						<div class="detail-media">
							<div class="product-gallery">
							  <ul class="slides">
							    <li data-thumb="{{asset('frontend/assets/images/products')}}/{{$gambar_produk->gambar1}}">
							    	<img src="{{asset('frontend/assets/images/products')}}/{{$gambar_produk->gambar1}}" alt="product thumbnail" />
							    </li>
							    <li data-thumb="{{asset('frontend/assets/images/products')}}/{{$gambar_produk->gambar2}}">
							    	<img src="{{asset('frontend/assets/images/products')}}/{{$gambar_produk->gambar2}}" alt="product thumbnail" />
							    </li>
								<li data-thumb="{{asset('frontend/assets/images/products')}}/{{$gambar_produk->gambar3}}">
							    	<img src="{{asset('frontend/assets/images/products')}}/{{$gambar_produk->gambar3}}" alt="product thumbnail" />
							    </li>
								<li data-thumb="{{asset('frontend/assets/images/products')}}/{{$gambar_produk->gambar4}}">
							    	<img src="{{asset('frontend/assets/images/products')}}/{{$gambar_produk->gambar4}}" alt="product thumbnail" />
							    </li>
								<li data-thumb="{{asset('frontend/assets/images/products')}}/{{$gambar_produk->gambar5}}">
							    	<img src="{{asset('frontend/assets/images/products')}}/{{$gambar_produk->gambar5}}" alt="product thumbnail" />
							    </li>
							  </ul>
							</div>
						</div>
						<div class="detail-info">
							<div class="span6">
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
							</div>
							<div class="product-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <a href="#" class="count-review">(05 review)</a>
                            </div>
                            <h2 class="product-name">{{$detail_produk->name}}</h2>
                            <div class="short-desc">
                                <ul>
                                    {{$detail_produk->deskripsi_singkat}}
                                    <li>FaceTime HD Camera 7.0 MP Photos</li> 
                                </ul>
                            </div>
                            <div class="wrap-social">
                            	<a class="link-socail" href="#"><img src="{{asset('frontend/assets/images/social-list.png')}}" alt=""></a>
                            </div>
							<form action="{{route('TambahKeKeranjang')}}" method="post">
								@csrf
								@php
                                    $harga_diskon = Produk::tampilDiskon($detail_produk['id']); 
                                @endphp
                            <div class="wrap-price">
								@if($harga_diskon>0)
                                    <del><p class="product-price">@currency($detail_produk->harga)</p></del>
                                @else
                                    <ins><p class="product-price">@currency($detail_produk->harga)</p></ins>
                                @endif
                                @if($harga_diskon>0)
                                    <ins><p class="product-price">@currency($harga_diskon)</p></ins>
                                @endif
							</div>

                            <div class="stock-info in-stock">
                                <p class="availability">Stok: <span class="tampilAtributStok"></span></p>
								<input type="hidden" class="tampilBerat" value="" name="berat">
                            </div>

							<div class="stock-info in-stock">
								<div class="row" style="margin-top:18px">
									<div class="col-xs-2">
										<p>Ukuran</p>
									</div>
									<form action="{{route('TambahKeKeranjang')}}" method="post">
										@csrf
										@if (Route::has('HalamanLogin'))
										@auth
										<input type="hidden" name="user_id" value="{{(Auth::user()->id)}}" hidden>
										<input type="hidden" name="produk_id" value="{{$detail_produk->id}}" hidden>
										<input type="hidden" name="harga" value="{{$detail_produk->harga}}" hidden>
										@else
										@endif
										@endif
										<div class="col-xs-4">
										
											<select name="ukuran" id="tampilHarga" produk-id="{{$detail_produk->id}}" class="form-control" style="width:200px" required>
												<option value="" selected disabled>Pilih Ukuran</option>
												@foreach ($produk_atribut as $produk_atributs)
												<option value="{{$produk_atributs->ukuran}}">{{$produk_atributs->ukuran}}</option>
												@endforeach
											</select>
										</div>
								</div>
							</div>

                            <div class="quantity">
                            	<span>Quantity:</span>
								<div class="quantity-input">
									<input type="text" name="kuantitas" id="kuantitas" value="1" data-max="" pattern="[0-9]*">
									<a class="btn btn-reduce" href="#"></a>
									<a class="btn btn-increase" href="#"></a>
								</div>
							</div>
							<div class="wrap-butons">
								@if (Route::has('HalamanLogin'))
								@auth
								<a class="btn add-to-cart"><button style="background:transparent; border:none; width:100%;">Add to Cart</button></a>
								@else
								<a href="{{route('HalamanLogin')}}" class="btn add-to-cart">Add to Cart</a>
								@endif
								@endif
                                <div class="wrap-btn">
                                    <a href="#" class="btn btn-compare">Add Compare</a>
                                    <a href="#" class="btn btn-wishlist">Add Wishlist</a>
                                </div>
							</div>
						</form>
						</div>
						<div class="advance-info">
							<div class="tab-control normal">
								<a href="#description" class="tab-control-item active">description</a>
								<a href="#add_infomation" class="tab-control-item">Addtional Infomation</a>
								<a href="#review" class="tab-control-item">Reviews</a>
							</div>
							<div class="tab-contents">
								<div class="tab-content-item active" id="description">
									<p>Lorem ipsum dolor sit amet, an munere tibique consequat mel, congue albucius no qui, a t everti meliore erroribus sea. ro cum. Sea ne accusata voluptatibus. Ne cum falli dolor voluptua, duo ei sonet choro facilisis, labores officiis torquatos cum ei.</p>
									<p>Cum altera mandamus in, mea verear disputationi et. Vel regione discere ut, legere expetenda ut eos. In nam nibh invenire similique. Atqui mollis ea his, ius graecis accommodare te. No eam tota nostrum eque. Est cu nibh clita. Sed an nominavi, et stituto, duo id rebum lucilius. Te eam iisque deseruisse, ipsum euismod his at. Eu putent habemus voluptua sit, sit cu rationibus scripserit, modus taria . </p>
									<p>experian soleat maluisset per. Has eu idque similique, et blandit scriptorem tatibus mea. Vis quaeque ocurreret ea.cu bus  scripserit, modus voluptaria ex per.</p>
								</div>
								<div class="tab-content-item " id="add_infomation">
									<table class="shop_attributes">
										<tbody>
											<tr>
												<th>Weight</th><td class="product_weight">1 kg</td>
											</tr>
											<tr>
												<th>Dimensions</th><td class="product_dimensions">12 x 15 x 23 cm</td>
											</tr>
											<tr>
												<th>Color</th><td><p>Black, Blue, Grey, Violet, Yellow</p></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="tab-content-item " id="review">
									
									<div class="wrap-review-form">
										
										<div id="comments">
											<h2 class="woocommerce-Reviews-title">01 review for <span>Radiant-360 R6 Chainsaw Omnidirectional [Orage]</span></h2>
											<ol class="commentlist">
												<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
													<div id="comment-20" class="comment_container"> 
														<img alt="" src="{{asset('frontend/assets/images/author-avata.jpg')}}" height="80" width="80">
														<div class="comment-text">
															<div class="star-rating">
																<span class="width-80-percent">Rated <strong class="rating">5</strong> out of 5</span>
															</div>
															<p class="meta"> 
																<strong class="woocommerce-review__author">admin</strong> 
																<span class="woocommerce-review__dash">–</span>
																<time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" >Tue, Aug 15,  2017</time>
															</p>
															<div class="description">
																<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
															</div>
														</div>
													</div>
												</li>
											</ol>
										</div><!-- #comments -->

										<div id="review_form_wrapper">
											<div id="review_form">
												<div id="respond" class="comment-respond"> 

													<form action="#" method="post" id="commentform" class="comment-form" novalidate="">
														<p class="comment-notes">
															<span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
														</p>
														<div class="comment-form-rating">
															<span>Your rating</span>
															<p class="stars">
																
																<label for="rated-1"></label>
																<input type="radio" id="rated-1" name="rating" value="1">
																<label for="rated-2"></label>
																<input type="radio" id="rated-2" name="rating" value="2">
																<label for="rated-3"></label>
																<input type="radio" id="rated-3" name="rating" value="3">
																<label for="rated-4"></label>
																<input type="radio" id="rated-4" name="rating" value="4">
																<label for="rated-5"></label>
																<input type="radio" id="rated-5" name="rating" value="5" checked="checked">
															</p>
														</div>
														<p class="comment-form-author">
															<label for="author">Name <span class="required">*</span></label> 
															<input id="author" name="author" type="text" value="">
														</p>
														<p class="comment-form-email">
															<label for="email">Email <span class="required">*</span></label> 
															<input id="email" name="email" type="email" value="" >
														</p>
														<p class="comment-form-comment">
															<label for="comment">Your review <span class="required">*</span>
															</label>
															<textarea id="comment" name="comment" cols="45" rows="8"></textarea>
														</p>
														<p class="form-submit">
															<input name="submit" type="submit" id="submit" class="submit" value="Submit">
														</p>
													</form>

												</div><!-- .comment-respond-->
											</div><!-- #review_form -->
										</div><!-- #review_form_wrapper -->

									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!--end main products area-->

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
					<div class="widget widget-our-services ">
						<div class="widget-content">
							<ul class="our-services">

								<li class="service">
									<a class="link-to-service" href="#">
										<i class="fa fa-truck" aria-hidden="true"></i>
										<div class="right-content">
											<b class="title">Free Shipping</b>
											<span class="subtitle">On Oder Over $99</span>
											<p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
										</div>
									</a>
								</li>

								<li class="service">
									<a class="link-to-service" href="#">
										<i class="fa fa-gift" aria-hidden="true"></i>
										<div class="right-content">
											<b class="title">Special Offer</b>
											<span class="subtitle">Get a gift!</span>
											<p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
										</div>
									</a>
								</li>

								<li class="service">
									<a class="link-to-service" href="#">
										<i class="fa fa-reply" aria-hidden="true"></i>
										<div class="right-content">
											<b class="title">Order Return</b>
											<span class="subtitle">Return within 7 days</span>
											<p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div><!-- Categories widget-->

					<div class="widget mercado-widget widget-product">
						<h2 class="widget-title">Popular Products</h2>
						<div class="widget-content">
							<ul class="products">
							@foreach ($populer_produk as $populer_produks)
								
								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="{{route('HalamanDetailProduk',$populer_produks->slug)}}" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
												<figure><img src="{{asset('frontend/assets/images/products')}}/{{$populer_produks->gambar}}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="{{route('HalamanDetailProduk',$populer_produks->slug)}}" class="product-name"><span>{{$populer_produks->name}}</span></a>
											<div class="wrap-price"><span class="product-price">@currency($populer_produks->harga)</span></div>
										</div>
									</div>
								</li>

							@endforeach	
							
							</ul>
						</div>
					</div>

				</div><!--end sitebar-->

				<div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="wrap-show-advance-info-box style-1 box-in-site">
						<h3 class="title-box">Related Products</h3>
						<div class="wrap-products">
							<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

								@foreach ($terkait_produk as $terkait_produks)
									
								<div class="product product-style-2 equal-elem ">
									<div class="product-thumnail">
										<a href="{{route('HalamanDetailProduk',$terkait_produks->slug)}}" title="{{$terkait_produks->name}}">
											<figure><img src="{{asset('frontend/assets/images/products')}}/{{$terkait_produks->gambar}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
										</a>
										<div class="group-flash">
											<span class="flash-item new-label">new</span>
										</div>
										<div class="wrap-btn">
											<a href="{{route('HalamanDetailProduk',$terkait_produks->slug)}}" class="function-link">quick view</a>
										</div>
									</div>
									<div class="product-info">
										<a href="{{route('HalamanDetailProduk',$terkait_produks->slug)}}" class="product-name"><span>{{$terkait_produks->name}}</span></a>
										<div class="wrap-price"><span class="product-price">@currency($terkait_produks->harga)</span></div>
									</div>
								</div>

								@endforeach

							</div>
						</div><!--End wrap-products-->
					</div>
				</div>

			</div><!--end row-->

		</div><!--end container-->

	</main>
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
			var berat =  $(this).attr('value');
			
			if (ukuran==""){
				alert("Mohon Pilih Ukuran");
				return false;
			}

			$.ajax({
				url: '/tampilProdukStok',
				data:{berat:berat, ukuran:ukuran, produk_id:produk_id},
				type:'post',
				success:function(resp){
					$(".tampilAtributStok").html(resp);
					$('#kuantitas').attr("data-max", resp).val(1);
				}, error:function(){
					alert("error");
				}
			});

			$.ajax({
				url: '/tampilBerat',
				data:{berat:berat, ukuran:ukuran, produk_id:produk_id},
				type:'post',
				success:function(resp){
					$('.tampilBerat').attr("value", resp).val(resp);
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