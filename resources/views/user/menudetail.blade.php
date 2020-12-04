@extends('user.app')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">{{ $menu->namaMenu }}</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-black">{{ $menu->namaMenu }}</h2>
                    <p>
                        {{ $menu->description }}
                    </p>
                    <p><strong class="text-primary h4">Rp {{ $menu->harga }} </strong></p>

                    <div class="mb-5">
                        <form action="{{ route('user.keranjang.pesan') }}" method="post">
                            @csrf
                            @if (Route::has('login'))
                                @auth
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                @endauth
                            @endif
                            <input type="hidden" name="products_id" value="{{ $menu->id }}">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="text" name="qty" class="form-control text-center" value="1" placeholder=""
                                    aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>

                    </div>
                    <button type="submit" clss="btn btn-sm btn-primary">Add To Cart</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
