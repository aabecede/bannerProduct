@extends('landing-page.layout.index')
@section('content')
    <style>
        .max-size-produk {
            max-width: 450px !important;
            max-height: 180px !important;
            object-fit: fill;
        }
    </style>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
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
                                    <a class="btn btn-outline-dark mt-auto" href="{{ url("produk/$item->id") }}">Lihat Detail</a>
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
