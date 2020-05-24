<div id="header">
        <div class="header-top">
            <div class="container">
                <div class="pull-left auto-width-left">
                    <ul class="top-menu menu-beta l-inline">
                        <li><a href=""><i class="fa fa-home"></i> 90-92 Trần Hưng Đạo, Hà Nội</a></li>
                        <li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
                    </ul>
                </div>
                <div class="pull-right auto-width-right">
                    <ul class="top-details menu-beta l-inline">
                        <li><a href="{{route('frontend.cart.index')}}"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- .container -->
        </div> <!-- .header-top -->
        <div class="header-body">
            <div class="container beta-relative">
                <div class="pull-left">
                    <a href="index.html" id="logo"><img src="assets/dest/images/logo-cake.png" width="200px" alt=""></a>
                </div>
                <div class="clearfix"></div>
            </div> <!-- .container -->
        </div> <!-- .header-body -->
        <div class="header-bottom" style="background-color: #0277b8;">
            <div class="container">
                <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
                <div class="visible-xs clearfix"></div>
                <nav class="main-menu">
                    <ul class="l-inline ov">
                        <li><a href="{{route('frontend.index')}}">Trang chủ</a></li>
                        <li><a href="#">Danh mục</a>
                            {{-- @foreach($categories as $category)
                                    <li class="hassubs">
                                        <a href="{{route('frontend.shop.menu', $category->id)}}">{{$category->name}}<i class="fas fa-chevron-right"></i></a>
                                        <ul>
                                            @foreach($categorieall as $cat)
                                            @if($cat->parent_id==$category->id)
                                            <li><a href="{{route('frontend.shop.menu', $cat->id)}}">{{$cat->name}}<i class="fas fa-chevron-right"></i></a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach --}}
                                    <ul class="sub-menu">
                                    @foreach($categories as $category)

                                        <li><a href="{{route('frontend.shop.menu', $category->id)}}">{{$category->name}}</a>
                                           <ul class="sub-menu">
                                            @foreach($categorieall as $cat)
                                            @if($cat->parent_id==$category->id)
                                            <li><a href="{{route('frontend.shop.menu', $cat->id)}}">{{$cat->name}}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                </ul>
                        </li>
                        <li><a href="{{route('frontend.shop.index')}}">Sản phẩm</a></li>
                        <li><a href="{{route('frontend.contact.index')}}">Liên hệ</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </nav>
            </div> <!-- .container -->
        </div> <!-- .header-bottom -->
    </div> <!-- #header -->