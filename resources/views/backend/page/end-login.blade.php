<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tăng tương tác ảo</title>
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body>
<ol class="breadcrumb">
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="card" style="height: 300px">
            <div class="row justify-content-center" style="align-items: center; margin-top: 80px;padding: 30px;">
                <h4>Phiên đăng nhập đã kết thúc vui lòng <a href="{{env('URL_SPM_LOGIN').'/logout'.'?urlRedirect='.route('do-logout')}}">BẤM VÀO ĐÂY</a> để đăng nhập lại</h4>
            </div>
            <div class="row justify-content-center" >
                <a class="btn btn-info" style="color: #fff; font-size: 16px;" href="{{env('URL_SPM_LOGIN').'/logout'.'?urlRedirect='.route('do-logout')}}">Đăng nhập</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>