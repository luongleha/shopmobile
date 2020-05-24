@extends('frontend.layouts.master')

@section('title')
Product Type
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
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{ route('frontend.index') }}">Trang chủ</a> / <span>Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<b>Tất cả danh mục</b>
						<ul class="aside-menu">
							@foreach($categorieall as $category)
							<li><a href="{{route('frontend.shop.menu', $category->id)}}">{{$category->name}}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Tất cả sản phẩm</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tất cả sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($products as $key => $product)
								<div class="col-sm-4">
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
{{-- 
						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Top Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">438 styles found</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="single-item">
										<div class="single-item-header">
											<a href="product.html"><img src="/frontend/assets/dest/images/products/1.jpg" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">Sample Woman Top</p>
											<p class="single-item-price">
												<span>$34.55</span>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="single-item">
										<div class="single-item-header">
											<a href="product.html"><img src="/frontend/assets/dest/images/products/1.jpg" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">Sample Woman Top</p>
											<p class="single-item-price">
												<span>$34.55</span>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="single-item">
										<div class="single-item-header">
											<a href="product.html"><img src="/frontend/assets/dest/images/products/1.jpg" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">Sample Woman Top</p>
											<p class="single-item-price">
												<span>$34.55</span>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list --> --}}
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
