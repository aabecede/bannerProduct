@extends('landing-page.layout.index')
@section('content')
    <style>
        .max-size-produk {
            max-width: 450px !important;
            max-height: 180px !important;
            object-fit: fill;
        }
        .fit-carousel{
            max-width: 100% !important;
            max-height: 550px !important;
            object-fit: fill;
        }
    </style>

    <!-- Header-->
    <header class="bg-dark py-5">

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                @foreach ($banner_produk as $key => $item)
                    @php
                        $active = '';
                        if ($loop->first) {
                            $active = 'active';
                        }
                    @endphp
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}"
                        class="{{ $active }}" aria-current="true" aria-label="Slide 1"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($banner_produk as $key => $item)
                    @php
                        $active = '';
                        if ($loop->first) {
                            $active = 'active';
                        }
                    @endphp
                    <div class="carousel-item {{ $active }} text-center">
                        <img src="{{ imageExists($item->path_gambar) }}" class="d-block fit-carousel" alt="{{ $key }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @forelse ($produk as $item)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top max-size-produk" src="{{ imageExists($item->path_gambar) }}"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"> {{ $item->name }} </h5>
                                    <!-- Product price-->
                                    {{ baseCurrencyFormat($item->harga) }}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ url("produk/$item->id") }}">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col mb-5 text-center">
                        <h4>Belum Ada Produk</h4>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $produk->links() !!}
        </div>
    </section>
@endsection
