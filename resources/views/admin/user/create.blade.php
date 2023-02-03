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
                        {{-- <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div> --}}
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">&nbsp;</h3>
                                        </div>
                                        {{-- {{dd(session('validator'))}} --}}
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form method="{{ $method }}" enctype="multipart/form-data" action="{{ $url_action }}" id="formBannerProduk">
                                            @csrf
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="gambar">Gambar</label>
                                                    <img class="img-preview img-fluid mb-3 col-sm-5 index-admin-image" src="{{ imageExists($banner_produk->path_gambar ?? null) }}" alt="">
                                                    <input type="file" id="gambar" name="path_gambar"
                                                        onchange="previewImage()" class="form-control">
                                                    {!! renderErrorViewValidator('path_gambar') !!}
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary"
                                                    id="btnSaveproduk">Submit</button>
                                            </div>
                                        </form>
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
@push('js')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Enter ...',
                height: 200
            });
        });

        function previewImage() {
            const image = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
