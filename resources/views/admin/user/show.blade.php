@extends('admin.baseLayout.index')
@push('css')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    @php
        $method = 'POST';
        $url_action = url('admin/user');
        if (!empty($user)) {
            $url_action = url('admin/user/edit/' . $user->id);
        } else {
            $user = null;
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
                                                    src="{{ imageExists($user->path_foto) }}" alt="">
                                                    <br>
                                                    <small>Creator : {{ $user->creator->name ?? $user->name }} | {{ baseDateFormat($user->created_at) }}</small>
                                            </div>
                                             <div class="form-group">
                                                <label for="title">Name</label>
                                                <input type="text" class="form-control" id="title" name="title" readonly value="{{ $user->name}}">
                                            </div>
                                             <div class="form-group">
                                                <label for="title">Phone</label>
                                                <input type="text" class="form-control" id="title" name="title" readonly value="{{ $user->phone}}">
                                            </div>
                                             <div class="form-group">
                                                <label for="title">Email</label>
                                                <input type="text" class="form-control" id="title" name="title" readonly value="{{ $user->email}}">
                                            </div>
                                             <div class="form-group">
                                                <label for="title">Is Admin</label>
                                                <input type="text" class="form-control" id="title" name="title" readonly value="{{ $user->is_admin ?? 0}}">
                                            </div>
                                             <div class="form-group">
                                                <label for="title">Is Verified</label>
                                                <input type="text" class="form-control" id="title" name="title" readonly value="{{ $user->is_verified ?? 0}}">
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
