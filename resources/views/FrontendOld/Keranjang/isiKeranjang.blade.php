<div class="wrap-iten-in-cart">
            <h3 class="box-title">Products Name</h3>
            <ul class="products-cart">
                <?php $total = 0; $sub_total = 0;?>
                @foreach($penggunaKeranjangItem as $item)
                <li class="pr-cart-item">
                    <div class="product-image">
                        @foreach ($gambar_produk as $gambar_produks)
                            @if ($item['produk']['id'] == $gambar_produks['gambar_produk']['produk_id'])
                            <figure>
                                <img src="{{ asset('frontend/assets/images/products/'.$gambar_produks['gambar_produk']['gambar1']) }}" alt="">
                            </figure>
                            @endif
                        @endforeach
                    </div>
                    <div class="product-name">
                        <a class="link-to-product" href="#">{{$item['produk']['name']}}<br>Ukuran : {{$item['ukuran']}}<br>Berat : {{$item['berat']}}</a>
                    </div>
                    <div class="price-field produtc-price"><p class="price">@currency($item['harga'])</p></div>
                    <div class="quantity">
                        <div class="quantity-input">
                            <input type="text" name="kuantitas" id="appendedInputButtons" value="{{$item['kuantitas']}}" pattern="[0-9]*" >									
                            <button class="btn btnItemUpdate qtyMinus" type="button" data-cartid="{{$item['id']}}"><i class="fa fa-minus"></i></button>
                            <button class="btn btnItemUpdate qtyPlus" type="button" data-cartid="{{$item['id']}}"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <?php 
                        $total = $item['harga'] * $item['kuantitas']; 
                        $sub_total = $sub_total + ($item['harga'] * $item['kuantitas']);
                        ?>
                    <div class="price-field sub-total"><p class="price">@currency($total)</p></div>
                    <div class="delete">
                    <button class="btn btnItemDelete" type="button" data-cartid="{{$item['id']}}"><i class="fa fa-times-circle"></i></button>
                    </div>
                </li>
                @endforeach	
            </ul>
        </div>
        <div class="summary">
            <div class="order-summary">
                <h4 class="title-box">Order Summary</h4>
                <p class="summary-info"><span class="title">Subtotal</span><b class="index">@currency($sub_total)</b></p>
                <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                <p class="summary-info total-info "><span class="title">Total</span><b class="index">@currency($sub_total)</b></p>
            </div>
            <div class="checkout-info">
                <!-- <label class="checkbox-field">
                    <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
                </label> -->
                @if ($hitungDataKeranjang > 0)
                <a class="btn btn-checkout" href="{{route('HalamanPemeriksaan')}}">Check out</a>
                @else
                <button class="btn btn-checkout" type="button" disabled>Check out</button>
                @endif
                <!-- <a class="link-to-shop" href="shop.html">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a> -->
            </div>
            <!-- <div class="update-clear">
                <a class="btn btn-clear" href="#">Clear Shopping Cart</a>
                <a class="btn btn-update" href="#">Update Shopping Cart</a>
            </div> -->
        </div>