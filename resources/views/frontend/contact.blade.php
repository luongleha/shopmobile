@extends('frontend.layouts.master')

@section('title')
Contacts
@endsection

@section('link-css')
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/frontend/assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="/frontend/assets/dest/vendors/colorbox/example3/colorbox.css">
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
	<link rel="stylesheet" title="style" href="/frontend/assets/dest/css/style.css">
	<link rel="stylesheet" href="/frontend/assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="/frontend/assets/dest/css/huong-style.css">
@endsection

@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Liên hệ</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{ route('frontend.index') }}">Trang chủ</a> / <span>Liên hệ</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="beta-map">
		
		<div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3678.0141923553406!2d89.551518!3d22.801938!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff8ff8ef7ea2b7%3A0x1f1e9fc1cf4bd626!2sPranon+Pvt.+Limited!5e0!3m2!1sen!2s!4v1407828576904" ></iframe></div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			
			<div class="space50">&nbsp;</div>
			<div class="row">
				<div class="col-sm-8">
					<h2>Form liên hệ</h2>
					<div class="space20">&nbsp;</div>
					<p>Chúng tôi luôn sẵn sàng hỗ trợ bạn</p>
					<div class="space20">&nbsp;</div>
					<form action="#" method="post" class="contact-form">	
						<div class="form-block">
							<input name="your-name" type="text" placeholder="Your Name (required)">
						</div>
						<div class="form-block">
							<input name="your-email" type="email" placeholder="Your Email (required)">
						</div>
						<div class="form-block">
							<input name="your-subject" type="text" placeholder="Subject">
						</div>
						<div class="form-block">
							<textarea name="your-message" placeholder="Your Message"></textarea>
						</div>
						<div class="form-block">
							<button type="submit" class="beta-btn primary">Gửi tin nhắn <i class="fa fa-chevron-right"></i></button>
						</div>
					</form>
				</div>
				<div class="col-sm-4">
					<h2>Contact Information</h2>
					<div class="space20">&nbsp;</div>

					<h6 class="contact-title">Địa chỉ</h6>
					<p>
						Suite 127 / 267 – 277 Ha noi,<br>
						62 <br>
						Ha Noi
					</p>
					<div class="space20">&nbsp;</div>
					<h6 class="contact-title">Business Enquiries</h6>
					<p>
						Doloremque laudantium, totam rem aperiam, <br>
						inventore veritatio beatae. <br>
						<a href="mailto:biz@betadesign.com">biz@betadesign.com</a>
					</p>
					<div class="space20">&nbsp;</div>
					<h6 class="contact-title">Employment</h6>
					<p>
						We’re always looking for talented persons to <br>
						join our team. <br>
						<a href="hr@betadesign.com">hr@betadesign.com</a>
					</p>
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
	<script src="/frontend/assets/dest/vendors/utils/beta.utils.js"></script>
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