@extends('landing-page.layout.index')
@section('content')
    <style>
        .max-size-produk {
            max-width: 450px !important;
            max-height: 180px !important;
            object-fit: fill;
        }
    </style>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <a href="{{ url()->previous() }}" class="btn btn-info">
                                            Back
                                        </a>
                                    </h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group text-center">
                                        <img class="img-preview img-fluid mb-3 col-sm-5 index-admin-image"
                                            src="{{ imageExists($produk->path_gambar) }}" alt="">
                                        <br>
                                        <small>Creator : {{ $produk->creator->name }} |
                                            {{ baseDateFormat($produk->created_at) }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Nama</label>
                                        <input type="text" class="form-control" id="title" name="title" readonly
                                            value="{{ $produk->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Harga</label>
                                        <input type="text" class="form-control" id="title" name="title" readonly
                                            value="{{ baseCurrencyFormat($produk->harga) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Deskripsi</label>
                                        {!! $produk->deskripsi !!}
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
