@extends('user.app')
@section('content')
<div class="site-blocks-cover" style="background-image: url({{ asset('images') }}/makanan.jfif);" data-aos="fade">
    <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
            <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                <h1 class="mb-2">Rumah Makan Richie</h1>
                <div class="intro-text text-center text-md-left">
                    <p class="mb-4">Rumah makan yang sederhana tetapi berkualitas,hehehe dan pastinya harga terjangkau</p>
                    <p>
                        <a href="{{ route('user.menu') }}" class="btn btn-sm btn-primary">Order Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section site-section-sm site-blocks-1">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-star"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Cheff Ternama</h2>
                    <p>Cheff dalam Rumah Makan Richie semuanya memiliki gelar Master Cheff</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-thumbs-up "></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Rasanya Terjamin</h2>
                    <p>Rasa masakan kami terjamin enaknya.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-usd "></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Harga Terjangkau</h2>
                    <p>Harganya terjangkau bagi kalangan Anak Kos</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section block-3 site-blocks-2 bg-light"  data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Produk Terlaris</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel" >
                    @foreach($menu as $m)
                    <div class="item">
                        <div class="block-4 text-center">
                            <a href="{{ route('user.menu.detail',['id' =>  $m->id]) }}">
                            </a>
                            <div class="block-4-text p-4">
                                <h3><a href="{{ route('user.menu.detail',['id' =>  $m->id]) }}">{{ $m->namaMenu }}</a></h3>
                                <p class="mb-0">{{ $m->harga }}</p>
                                <a href="{{ route('user.menu.detail',['id' =>  $m->id]) }}" class="btn btn-primary mt-2">Detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection