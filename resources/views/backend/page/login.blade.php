
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
    <link href="http://buff.hacklike.biz/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="http://buff.hacklike.biz/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://buff.hacklike.biz/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="http://buff.hacklike.biz/css/style.css" rel="stylesheet">
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1><a href="http://vnpsoftware.biz/">VNP Software</a></h1>
                        <form action="" method="POST">
                            <input type="hidden" name="_token" value="VlempWYJ4677j2Qkz0FoHdTKSwvr4kqXDRIOwPPh">
                            {{csrf_field()}}
                            @if(Session::has('error'))
                                <p class="alert alert-danger">{{session::get('error')}}</p>
                            @endif

                            @if(!empty($username))
                                <span class="error">{{$username}}</span>
                            @endif
                            <div class="input-group mb-20" >
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                                </div>
                                <input class="form-control" type="email" placeholder="Email" name="email">
                            </div>
                            @if(!empty($password))
                                <span class="error">{{$password}}</span>
                            @endif
                            <div class="input-group mb-20">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-lock"></i>
                                </span>
                                </div>
                                <input class="form-control" type="password" placeholder="Password" name="password">
                            </div>

                            <div class="row" style="margin-top: 40px">
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary px-4" type="submit">Đăng nhập</button>
                                </div>
                            </div>
                        </form>
                        <div class="row" style="margin-top: 30px">
                            <div class="col-6 text-center"></div>
                            <a href="{{asset('/register')}}" class="col-6 text-center" type="button">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .error{
        color:red;
        font-style: italic;
    }
</style>
<!-- Bootstrap and necessary plugins-->
<script src="http://buff.hacklike.biz/vendors/jquery/js/jquery.min.js"></script>
<script src="http://buff.hacklike.biz/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="http://buff.hacklike.biz/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
<script src="http://buff.hacklike.biz/vendors/@coreui/coreui-pro/js/coreui.min.js"></script>
</body>
</html>
