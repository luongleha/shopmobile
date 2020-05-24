@extends('frontend.layouts.master')

@section('title')
BetaDesign
@endsection

@section('link-css')
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/frontend/assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="/frontend/assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" title="style" href="/frontend/assets/dest/css/style.css">
	<link rel="stylesheet" href="/frontend/assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="/frontend/assets/dest/css/huong-style.css">
@endsection

@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Giỏ hàng
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{ route('frontend.index') }}">Trang chủ</a> / <span>Giỏ hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			<p>Các sản phẩm có trong giỏ hàng bạn đã thêm</p>
			<div class="space25">&nbsp;</div>
			
			<!--price table-->
			@foreach($items as $item)
			<div class="col-sm-3">
			<div class="beta-pricing">
				<div class="pri-title"><h4>{{\Illuminate\Support\Str::limit($item->name, 15)}}</h4></div>
				<div class="clear"></div>
				<span class="pri-amo">
				<span class="price-currency"></span>
					<sup>{{$item->qty}}</sup>
					<sub>{{number_format($item->qty*$item->price)}} VND</sub>
				</span>
				<div class="clear"></div>
				<span class="beta-price-button">
					<form style="display: inline-block;" action="{{route('frontend.cart.destroy', $item->id)}}" method="post" accept-charset="utf-8">
						@csrf
						{{method_field('delete')}}
						<button type="submit" class="btn btn-danger">Delete</button>
                    </form>
				</span>
			</div>
			</div>
			@endforeach
			<br>
			<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Tổng tiền:</div>
								<div class="order_total_amount">{{Cart::total()}} VND</div>
							</div>
			</div>
			<button type="button" class="button cart_button_clear"><a href="{{ route('frontend.index') }}" style="color: red">Mua tiếp</a></button>
			<button type="button" class="button cart_button_checkout"><a href="{{ route('frontend.cart.pay') }}">Đặt hàng</a></button>
			<!--price table-->
			
			
			<div class="clear"></div>
			<div class="space20">&nbsp;</div>
		</div> <!-- #content -->
	</div> <!-- .container -->

   	@endsection

    @section('link-js')
	<!-- include js files -->
	<script src="/frontend/assets/dest/js/jquery.js"></script>
	<script src="/frontend/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="/frontend/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
	<script src="/frontend/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
	<script src="/frontend/assets/dest/vendors/animo/Animo.js"></script>
	<script src="/frontend/assets/dest/vendors/dug/dug.js"></script>
	<script src="/frontend/assets/dest/js/scripts.min.js"></script>
	<!--customjs-->
	<script type="text/javascript">
    $(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".main-menu a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
				$(this).parents('li').addClass('parent-active');
            }
        });
    });   


</script>
<script>
	 jQuery(document).ready(function($) {
                'use strict';
				
// color box

//color
      jQuery('#style-selector').animate({
      left: '-213px'
    });

    jQuery('#style-selector a.close').click(function(e){
      e.preventDefault();
      var div = jQuery('#style-selector');
      if (div.css('left') === '-213px') {
        jQuery('#style-selector').animate({
          left: '0'
        });
        jQuery(this).removeClass('icon-angle-left');
        jQuery(this).addClass('icon-angle-right');
      } else {
        jQuery('#style-selector').animate({
          left: '-213px'
        });
        jQuery(this).removeClass('icon-angle-right');
        jQuery(this).addClass('icon-angle-left');
      }
    });
				});
	</script>
@endsection