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
            <h2 class="display-5">Silahkan Lakukan Pembayaran</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row  mb-4">
                        <div class="col-md-12 text-center">
                            Pembayaran Sebesar Rp {{ number_format($order->subtotal,2,',','.') }} 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                            <label for="">Silahkan kekasir dan tunjukan kode ini </label>
                            <input type="text" name="bukti_pembayaran" id="" class="form-control" required value="{{$order->invoice}}" readonly="readonly">
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    </div>
</div>
@endsection