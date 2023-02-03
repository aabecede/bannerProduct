<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Document</title>
</head>
<style>
    .gradient-custom {
        /* fallback for old browsers */
        background: #f093fb;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1))
    }

    .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }

    .card-registration .select-arrow {
        top: 13px;
    }
</style>

<body>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                            <form method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">

                                        <div class="form-outline">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" id="name" name="name" class="form-control form-control-lg" required />
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
                                            <input type="email" id="emailAddress" name="email" class="form-control form-control-lg" required />
                                            <label class="form-label" for="emailAddress">Email</label>
                                            {!! renderErrorViewValidator('email') !!}
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="number" id="phoneNumber" name="phone" class="form-control form-control-lg" required />
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                            {!! renderErrorViewValidator('phone') !!}
                                        </div>

                                    </div>
                                    <div class="col-md-12 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                                            <label class="form-label" for="password">Password</label>
                                            {!! renderErrorViewValidator('password') !!}
                                        </div>

                                    </div>
                                </div>
                                <div class="mt-4 pt-2">
                                    <input class="btn btn-primary btn-lg" type="submit" />
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            type: "GET",
            url: "{{url('gender/list')}}",
            dataType: "json",
            success: function (response) {
                // console.log(response)
                let html = ''
                if(response.code == 200){
                    $.each(response?.data, function (index, value) {
                        if(index == 0){
                            checked = 'checked';
                        }
                        else{
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
            error : function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown)
            }
        });
    });
</script>

</html>
