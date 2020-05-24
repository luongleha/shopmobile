@extends('frontend.layouts.master')

@section('title')
Product
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
				<h6 class="inner-title">Chi tiết sản phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{ route('frontend.index') }}">Trang chủ</a> / <span>Chi tiết sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							@foreach($path as $key => $image)
		                    @if($key == 0)
		                        <img src="/{{$image->path}}" alt="">
		                    @endif
		                    @endforeach
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title">{{$products->name}}</p>
								<p class="single-item-price">
									<span>{{number_format($products->sale_price)}} VND </span>
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{!! $products->content !!}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
								<select class="wc-select" name="color">
									<option>Số lượng</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<a class="add-to-cart" href="/online/cart/add/{{$products->id}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Mô tả</a></li>
							<li><a href="#tab-reviews">Reviews (0)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{!! $products->content !!}</p>
							<p>Sản phẩm thời thượng bắt kịp trào lưu và mẫu mã 2020</p>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Top 3 Sản phẩm</h4>

						<div class="row">
							@foreach($tops as $top)
							<div class="col-sm-4">
								<div class="single-item">
									<div class="single-item-header">
										<a href="{{route('frontend.products.show', $top->id)}}">
											@foreach($top->images as $key => $image)
                                                    @if($key == 0)
                                                        <img class="image-product" src="/{{$image['path']}}" alt="">
                                                    @endif
                                                @endforeach
                                        </a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$top->name}}</p>
										<p class="single-item-price">
											<span>{{number_format($top->sale_price)}} VND </span>
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="/online/cart/add/{{$top->id}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('frontend.products.show', $top->id)}}">Chi tiết<i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Sản phẩm giá hot</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($sales as $sale)
								<div class="media beta-sales-item">
									<a class="pull-left" href="{{route('frontend.products.show', $sale->id)}}">
										@foreach($sale->images as $key => $image)
                                                    @if($key == 0)
                                                        <img class="image-product" src="/{{$image['path']}}" alt="">
                                                    @endif
                                                @endforeach
                                    </a>
									<div class="media-body">
										{{$sale->name}}
										<br>
										<span class="beta-sales-price">{{number_format($sale->sale_price)}} VND </span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">Sản phẩm mới</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($news as $new)
								<div class="media beta-sales-item">
									<a class="pull-left" href="{{route('frontend.products.show', $new->id)}}">
										@foreach($new->images as $key => $image)
                                                    @if($key == 0)
                                                        <img class="image-product" src="/{{$image['path']}}" alt="">
                                                    @endif
                                                @endforeach
                                    </a>
									<div class="media-body">
										{{$new->name}}
										<br>
										<span class="beta-sales-price">{{number_format($new->sale_price)}} VND </span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
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