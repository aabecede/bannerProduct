@extends('admin.baseLayout.index')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> --}}
@endpush
@section('content')
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
                                {{-- <div class="col-12 mb-3 text-right">
                                    <a href="{{ url('admin/list-user/create') }}" class="btn btn-primary">Create Users</a>
                                </div> --}}
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Pengguna</th>
                                        <th class="text-center">Is Admin</th>
                                        <th class="text-center">Is Verified</th>
                                        <th class="text-center">Path Foto</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $item)
                                        <tr>
                                            <td>
                                                <span class="badge badge-primary">{{ $item->name }}</span><br>
                                                <span class="badge badge-default">{{ $item->phone ?? 'Belum Punya' }}</span><br>
                                                <span class="badge badge-info">{{ $item->email }}</span><br>
                                            </td>
                                            <td>{{ $item->is_admin ?? 0 }}</td>
                                            <td>{{ $item->is_verified ?? 0 }}</td>
                                            <td><img src="{{ imageExists($item->path_foto) }}"></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary"
                                                    href="{{ url()->current() }}/{{ $item->id }}">
                                                    Detail
                                                </a>
                                                {{-- <a class="btn btn-warning"
                                                    href="{{ url()->current() }}/{{ $item->id }}/edit">
                                                    Edit
                                                </a> --}}
                                                <button class="btn btn-danger" id="btnDeleteUser"
                                                    data-id="{{ $item->id }}" type="button">
                                                    Delete
                                                </button>

                                                @if($item->is_verified == 0 || empty($item->is_verified))
                                                    <button class="btn btn-info" id="btnVerifikasiUser"
                                                        data-id="{{ $item->id }}" type="button">
                                                        Verifikasi
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="5" class="text-center"> Tidak ada Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {!! $users->links() !!}
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
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).on('click', '#btnDeleteUser', function() {
            let id = $(this).data('id')
            let this_button = $(this)
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: `${BASE_URL}/admin/list-user/${id}`,
                        dataType: "json",
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            if (response.code == 200) {
                                window.location.href = response.url
                            }

                        },
                        error: function(response) {
                            $('#main-page-loading').css('display', 'none')
                            $("#loading-button").remove()
                            $(this_button).attr('disabled', false)
                            // console.log(response.responseJSON.code)
                            if (response.responseJSON.code == 400) {
                                return validatorMessageJs({
                                    message: response.responseJSON.message
                                });
                            } else {
                                return swalTerjadiKesalahanServer()
                            }
                        }
                    });
                }
            })
        })
        $(document).on('click', '#btnVerifikasiUser', function() {
            let id = $(this).data('id')
            let this_button = $(this)
            Swal.fire({
                title: 'Are you sure to Verified?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Verified it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: `${BASE_URL}/admin/list-user/verified/${id}`,
                        dataType: "json",
                        success: function(response) {
                            Swal.fire(
                                'Verified!',
                                'Account Verified',
                                'success'
                            )
                            if (response.code == 200) {
                                window.location.href = response.url
                            }

                        },
                        error: function(response) {
                            $('#main-page-loading').css('display', 'none')
                            $("#loading-button").remove()
                            $(this_button).attr('disabled', false)
                            // console.log(response.responseJSON.code)
                            if (response.responseJSON.code == 400) {
                                return validatorMessageJs({
                                    message: response.responseJSON.message
                                });
                            } else {
                                return swalTerjadiKesalahanServer()
                            }
                        }
                    });
                }
            })
        })
    </script>
@endpush
