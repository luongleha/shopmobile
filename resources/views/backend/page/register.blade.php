<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Tăng tương tác ảo">
    <meta name="author" content="VNP Software">
    <meta name="keyword" content="livestream, bufflike, buffsub, buffview, seed, comment">
    <title>CoreUI Pro Bootstrap Admin Template</title>
    <!-- Icons-->
    <link href="{{asset('vendors/@coreui/icons/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <div style="display: flex; justify-content: center; margin-bottom: 20px">
                        <img src="{{asset('images/logo_buff.jpeg')}}" width="135" height="100" style="margin-left: -15px;" alt="">
                    </div>
                    <h1 class="text-center" style="margin-bottom: 8px;color: #2069b5;">Flyteam</h1>
                    <h3 class="text-center" style="margin-bottom: 45px;font-weight: 800;font-size: 18px;
                               color: #c51111">Có comment là có đơn hàng</h3>
                    <p class="text-muted"></p>
                    <form action="" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" placeholder="Tên" name="full_name">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input class="form-control" type="email" placeholder="Email" name="email">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                            </div>
                            <input class="form-control" type="password" placeholder="Mật khẩu" name="password">
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                            </div>
                            <input class="form-control" type="password" placeholder="Nhập lại mật khẩu" name="password_confirmation">
                        </div>
                        <button class="btn btn-block btn-primary" type="submit">Tạo tài khoản</button>
                    </form>
                </div>
{{--                <div class="card-footer p-4">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <button class="btn btn-block btn-facebook" type="button">--}}
{{--                                <span>facebook</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <button class="btn btn-block btn-twitter" type="button">--}}
{{--                                <span>twitter</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap and necessary plugins-->
<script src="{{asset('vendors/jquery/js/jquery.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/perfect-scrollbar/js/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('vendors/@coreui/coreui-pro/js/coreui.min.js')}}"></script>
</body>
</html>
