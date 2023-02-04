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
                                    <form method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-3">

                                                <div class="form-outline">
                                                    <label class="form-label" for="name">Name</label>
                                                    <input type="text" id="name" name="name" value="{{auth()->user()->name}}"
                                                        class="form-control form-control-lg" required />
                                                    {!! renderErrorViewValidator('name') !!}
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">

                                                <h6 class="mb-2 pb-1">Gender: </h6>
                                                <div class="content-gender">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <label class="form-label" for="emailAddress">Email</label>
                                                    <input type="email" id="emailAddress" name="email" value="{{auth()->user()->email}}"
                                                        class="form-control form-control-lg" required />
                                                    {!! renderErrorViewValidator('email') !!}
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                                    <input type="number" id="phoneNumber" name="phone" value="{{auth()->user()->phone}}"
                                                        class="form-control form-control-lg" required />
                                                    {!! renderErrorViewValidator('phone') !!}
                                                </div>

                                            </div>
                                            {{-- <div class="col-md-12 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input type="password" id="password" name="password" value="{{auth()->user()->password}}"
                                                        class="form-control form-control-lg" required />
                                                    {!! renderErrorViewValidator('password') !!}
                                                </div>

                                            </div> --}}
                                            <div class="col-md-12 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <label class="form-label" for="selfie">Selfie</label>
                                                    <img src="{{ imageExists(auth()->user()->path_foto) }}" class="form-control">
                                                    <input type="file" name="selfie" class="form-control"><br>
                                                    <button id="btnKamera" class="btn btn-info" type="button">Upload Via
                                                        Kamera</button>
                                                    <input class="btn btn-default" type=button value="Take Snapshot"
                                                        id="takeSnap" onClick="take_snapshot()">
                                                    <input type="hidden" name="via_kamera">
                                                    <div id="my_camera"></div>
                                                    <div id="preview_selfie"></div>
                                                    {!! renderErrorViewValidator('selfie') !!}
                                                </div>

                                            </div>
                                        </div>
                                        <div class="mt-4 pt-2">
                                            <input class="btn btn-primary btn-lg btn-submit" type="submit" />
                                            <a href="{{ url('logout') }}">Logout</a>
                                        </div>

                                    </form>
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
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/dist/js/webcam.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "{{ url('gender/list') }}",
                dataType: "json",
                success: function(response) {
                    // console.log(response)
                    let html = ''
                    if (response.code == 200) {
                        $.each(response?.data, function(index, value) {
                            if (value?.id == `{{ auth()->user()->gender }}`) {
                                checked = 'checked';
                            } else {
                                checked = '';
                            }
                            html += `
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="${value?.name}Gender">${value?.name}</label>
                                &nbsp;
                                <input class="form-check-input" type="radio" name="gender" id="${value?.name}Gender" value="${value?.id}" ${checked} />
                                {!! renderErrorViewValidator('gender') !!}
                            </div>
                        `
                        });
                    }
                    $('.content-gender').html(html);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown)
                }
            });
        });

        $(document).on('click', '#btnKamera', function() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#my_camera');
        })

        $(document).on('submit', '.btn-submit', function(e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('avatar_cam', $('[name="via_kamera"]').val());
            formData.append('name', $('[name="name"]').val());
            formData.append('email', $('[name="email"]').val());
            formData.append('phone', $('[name="phone"]').val());
            formData.append('password', $('[name="password"]').val());
            formData.append('selfie', $('[name="selfie"]').val());

            $.ajax({
                type: "POST",
                url: "{{ url()->current() }}",
                data: formData,
                success: function(response) {
                    window.reload();
                }
            });
        })
    </script>

    <!-- Code to handle taking the snapshot and displaying it locally -->
    <script language="JavaScript">
        function take_snapshot() {
            // take snapshot and get image data
            Webcam.snap(function(data_uri) {
                $('[name="via_kamera"]').val(data_uri)
                // display results in page
                document.getElementById('preview_selfie').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
    </script>
@endpush
