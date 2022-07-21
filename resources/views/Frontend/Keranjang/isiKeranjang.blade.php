<div class="cart">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
<table class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Kuantitas</th>
            <th>Sub Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; $sub_total = 0;?>
@foreach($penggunaKeranjangItem as $item)
<tr>
    <td class="product-col">
        <div class="product" style="background-color: transparent">
                <figure class="product-media">
                    <a href="#">
                        @foreach ($gambar_produk as $gambar_produks)
                        @if ($item['produk']['id'] == $gambar_produks->produk_id)
                            <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambar_produks->gambar1 }}">
                        @endif
                        @endforeach
                    </a>
                </figure>
            <h3 class="product-title">
                <a href="#">{{$item['produk']['name']}}<br>Ukuran : {{$item['ukuran']}}</a>
            </h3>
        </div>
    </td>
    <td class="price-col">@currency($item['harga'])</td>
    <td class="quantity-col">
        <div class="cart-product-quantity">
            <input type="text" name="kuantitas" id="appendedInputButtons" 
                    value="{{$item['kuantitas']}}" pattern="[0-9]*" class="form-control" style="text-align: center" >
                <button class="btn btn-decrement btn-spinner btnItemUpdate qtyMinus" 
                    type="button" data-cartid="{{$item['id']}}"><i class="icon-minus"></i></button>
                <button class="btn btn-increment btn-spinner btnItemUpdate qtyPlus" 
                    type="button" data-cartid="{{$item['id']}}"><i class="icon-plus"></i></button>
        </div>
    </td>
    <?php 
        $total = $item['harga'] * $item['kuantitas']; 
        $sub_total = $sub_total + ($item['harga'] * $item['kuantitas']);
    ?>
    <td class="total-col">@currency($total)</td>
    <td class="remove-col"><button class="btn btnItemDelete" 
        type="button" data-cartid="{{$item['id']}}"><i class="icon-close"></i></button></td>
</tr>
@endforeach
    </tbody>
</table>
            </div><!-- End .col-lg-9 -->
            <aside class="col-lg-3">
                <div class="summary summary-cart">
                    <h3 class="summary-title">Total </h3><!-- End .summary-title -->

                    <table class="table table-summary">
                        <tbody>
                            <tr class="summary-subtotal">
                                <td>Subtotal:</td>
                                <td>@currency($sub_total)</td>
                            </tr><!-- End .summary-subtotal -->
                            {{-- <tr class="summary-shipping">
                                <td>Alamat Pengiriman:</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr class="summary-shipping-row">
                                <td>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="free-shipping" name="shipping" class="custom-control-input">
                                        <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                                    </div><!-- End .custom-control -->
                                </td>
                                <td>$0.00</td>
                            </tr><!-- End .summary-shipping-row -->
                            
                            <tr class="summary-shipping-estimate">
                                <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                                <td>&nbsp;</td>
                            </tr><!-- End .summary-shipping-estimate --> --}}

                            <tr class="summary-total">
                                <td>Total:</td>
                                <td>@currency($sub_total)</td>
                            </tr><!-- End .summary-total -->
                        </tbody>
                    </table><!-- End .table table-summary -->

                    <a href="{{route('HalamanPemeriksaan')}}" class="btn btn-outline-primary-2 btn-order btn-block">Lanjut Pemeriksaan</a>
                </div><!-- End .summary -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .cart -->