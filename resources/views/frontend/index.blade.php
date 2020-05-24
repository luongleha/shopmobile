@extends('frontend.layouts.master')

@section('title')
Mobile Shopping
@endsection

@section('link-css')
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/frontend/assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="/frontend/assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="/frontend/assets/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="/frontend/assets/dest/rs-plugin/css/responsive.css">
	<link rel="stylesheet" title="style" href="/frontend/assets/dest/css/style.css">
	<link rel="stylesheet" href="/frontend/assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="/frontend/assets/dest/css/huong-style.css">
@endsection

@section('content')
	<div class="rev-slider">
	<div class="fullwidthbanner-container">
					<div class="fullwidthbanner">
						<div class="bannercontainer" >
					    <div class="banner" >
								<ul>
									<!-- THE FIRST SLIDE -->
						        	<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
						            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
													<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="/frontend/assets/dest/images/slide/black.png" data-src="/frontend/assets/dest/images/slide/black.png" data-src="/frontend/assets/dest/images/slide/black.png" data-src="/frontend/assets/dest/images/slide/black.png" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('/frontend/assets/dest/images/slide/black.png'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
													</div>
												</div>

						        </li>
								<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
						          <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
												<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="/frontend/assets/dest/images/slide/full_xr.jpg" data-src="/frontend/assets/dest/images/slide/full_xr.jpg" data-src="/frontend/assets/dest/images/slide/full_xr.jpg" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('/frontend/assets/dest/images/slide/full_xr.jpg'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
											</div>
											</div>

								<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
						            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
													<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="/frontend/assets/dest/images/slide/long.png" data-src="/frontend/assets/dest/images/slide/long.png" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('/frontend/assets/dest/images/slide/long.png'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
												</div>
											</div>

						        </li>
								</ul>
							</div>
						</div>

						<div class="tp-bannertimer"></div>
					</div>
				</div>
				<!--slider-->
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Sản phẩm mới</h4>
							<div class="beta-products-details">
								<p class="pull-left">Bộ sưu tập sản phẩm mới nhất tại shop</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($products as $key => $product)
								<div class="col-sm-3">
									<div class="single-item">
										<div class="single-item-header">
											<a href="{{route('frontend.products.show', $product->id)}}">
												@foreach($product->images as $key => $image)
                                                    @if($key == 0)
                                                        <img class="image-product" src="/{{$image['path']}}" alt="">
                                                    @endif
                                                @endforeach
                                            </a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$product->name}}</p>
											<p class="single-item-price">
												<span>{{number_format($product->sale_price)}} VND </span>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="/online/cart/add/{{$product->id}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('frontend.products.show', $product->id)}}">Chi tiết<i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Top sản phẩm</h4>
							<div class="beta-products-details">
								<p class="pull-left">Bộ sưu tập sản phẩm nằm trong top năm nay</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($hots as $hot)
								<div class="col-sm-3">
									<div class="single-item">
										<div class="single-item-header">
											<a href="{{route('frontend.products.show', $hot->id)}}">
												@foreach($hot->images as $key => $image)
                                                    @if($key == 0)
                                                        <img class="image-product" src="/{{$image['path']}}" alt="">
                                                    @endif
                                                @endforeach
                                            </a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$hot->name}}</p>
											<p class="single-item-price">
												<span>{{number_format($hot->sale_price)}} VND </span>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="/online/cart/add/{{$hot->id}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('frontend.products.show', $hot->id)}}">Chi tiết<i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<div class="space40">&nbsp;</div>
							<h4>Sản phẩm giảm giá</h4>
							<div class="beta-products-details">
								<p class="pull-left">Bộ sưu tập sản phẩm giảm giá hot nhất</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($sales as $sale)
								<div class="col-sm-3">
									<div class="single-item">
										<div class="single-item-header">
											<a href="{{route('frontend.products.show', $sale->id)}}">
												@foreach($sale->images as $key => $image)
                                                    @if($key == 0)
                                                        <img class="image-product" src="/{{$image['path']}}" alt="">
                                                    @endif
                                                @endforeach
                                            </a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$sale->name}}</p>
											<p class="single-item-price">
												<span>{{number_format($sale->sale_price)}} VND </span>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="/online/cart/add/{{$sale->id}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('frontend.products.show', $sale->id)}}">Chi tiết<i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
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
	<script src="/frontend/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="/frontend/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="/frontend/assets/dest/js/waypoints.min.js"></script>
	<script src="/frontend/assets/dest/js/wow.min.js"></script>
	<!--customjs-->
	<script src="/frontend/assets/dest/js/custom2.js"></script>
	<script>
	$(document).ready(function($) {    
		$(window).scroll(function(){
			if($(this).scrollTop()>150){
			$(".header-bottom").addClass('fixNav')
			}else{
				$(".header-bottom").removeClass('fixNav')
			}}
		)
	})
	</script>
@endsection
