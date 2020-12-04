@extends('user.app')
@section('content')
<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
    </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <h2 class="display-5">Detail Pesanan Anda</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">  
                <div class="card-body">
                <div class="row">
                <div class="col-md-8">
                    <table>
                        <tr>
                            <th>No Invoice</th>
                            <td>:</td>
                            <td>{{ $order->invoice }}</td>
                        </tr>
                        <tr>
                            <th>Status Pesanan</th>
                            <td>:</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <th>Total Pembayaran</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($order->subtotal,2,',','.') }}</td>
                        </tr>
                    </table>
                </div>
               <div class="col-md-4 text-right">
                    @if($order->status_order_id == 3)
                    <a href="{{ route('user.order.sudah',['id' => $order->id]) }}" onclik="return confirm('Yakin ingin melanjutkan ?')" class="btn btn-primary">Pesanan Di Terima</a><br>
                    <small>Tombol ini hanya boleh dipencet oleh waiter jika masakan sudah nyampai, Jika anda memencetnya berarti pesanan sudah dianggap diantar</small>
                    @endif
                </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th class="product-name">Nama menu</th>
                            <th class="product-price">Jumlah</th>
                            <th class="product-quantity" width="20%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $o)
                            <tr>
                                <td>{{ $o->nama_menu }}</td>
                                <td>{{ $o->qty }}</td>
                                <td>{{ $o->qty * $o->harga }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    
                </div>
                </div>
            </div>
        </div>
    </div>
    

    </div>
</div>
@endsection