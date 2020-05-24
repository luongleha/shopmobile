<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title')</title>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@yield('link-css')

</head>

<body>

<div class="super_container">
    
    <!-- Header -->
    @include('frontend.includes.header')
    <!--End Header -->

    <!-- content -->
    @yield('content')
    <!--End content -->
    
    <!-- Footer -->
    @include('frontend.includes.footer')
    <!--End Footer -->
</div>



@yield('link-js')
</body>

</html>