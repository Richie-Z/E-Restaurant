@extends('user.app')
@section('content')
<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
    </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
    <div class="row mb-5">
        <form class="col-md-12" method="post" action="{{ route('user.keranjang.update') }}">
        @csrf
            <table class="table table-bordered">
            <thead>
                <tr>
                <th class="product-name">Produk</th>
                <th class="product-price">Harga</th>
                <th class="product-quantity">Jumlah</th>
                <th class="product-total">Total</th>
                <th class="product-remove">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                <?php $subtotal=0; foreach($keranjangs as $keranjang): ?>
                <td class="product-name">
                    <h2 class="h5 text-black">{{ $keranjang->nama_menu }}</h2>
                </td>
                <td>Rp. {{ number_format($keranjang->harga,2,',','.') }} </td>
                <td>
                    <div class="input-group mb-3" style="max-width: 120px;">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                    </div>
                    <input type="hidden" name="id[]" value="{{ $keranjang->id }}">
                    <input type="text" name="qty[]" class="form-control text-center" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="{{ $keranjang->qty }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                    </div>
                    </div>

                </td>
                <?php
                    $total = $keranjang->harga * $keranjang->qty;
                    $subtotal = $subtotal + $total;
                ?>
                <td>Rp. {{ number_format($total,2,',','.') }}</td>
                <td><a href="{{ route('user.keranjang.delete',['id' => $keranjang->id]) }}" class="btn btn-primary btn-sm">X</a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
            </table>
        
    </div>

    <div class="row">
        <div class="col-md-6">
        <div class="row mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
            <button type="submit" class="btn btn-primary btn-sm btn-block">Update Keranjang</button>
            </div>
            </form>       
        </div>
        </div>
        <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
            <div class="col-md-7">
            <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Total Belanja</h3>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-6">
                <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                <strong class="text-black">Rp. {{ number_format($subtotal,2,',','.') }}</strong>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                <a href="{{ route('user.checkout') }}" class="btn btn-primary btn-lg py-3 btn-block" >Checkout</a>
                <small>Jika Merubah Quantity Pada Keranjang Maka Klik Update Keranjang Dulu Sebelum Melakukan Checkout</small>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection