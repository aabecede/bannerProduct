@extends('admin.baseLayout.index')
@push('css')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    @php
        $method = 'POST';
        $url_action = url('admin/banner-produk');
        if (!empty($banner_produk)) {
            $url_action = url('admin/banner-produk/edit/' . $banner_produk->id);
        } else {
            $banner_produk = null;
        }
    @endphp
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ url()->previous() }}" class="btn btn-info">
                                    Back
                                </a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">&nbsp;</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <img class="img-preview img-fluid mb-3 col-sm-5 index-admin-image"
                                                    src="{{ imageExists($banner_produk->path_gambar) }}" alt="">
                                                    <br>
                                                    <small>Creator : {{ $banner_produk->creator->name }} | {{ baseDateFormat($banner_produk->created_at) }}</small>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
