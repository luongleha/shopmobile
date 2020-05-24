<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout"
                data-action="sidebar_close">
                <i class="fa fa-times text-danger"></i>
            </button>
            <!-- END Close Sidebar -->

            <!-- Logo -->
            <div class="content-header-item">
                <a class="link-effect font-w700" href="{{route('home')}}">
                    <span class="font-size-xl text-dual-primary-dark">Mobile shop</span>
                </a>
            </div>
            <!-- END Logo -->
        </div>
        <!-- END Normal Mode -->
    </div>
    <!-- END Side Header -->

<!-- END Side User -->

<!-- Side Navigation -->
<div class="content-side content-side-full">
    <ul class="nav-main">
        {{-- <li>
            <a class="active" href="{{route('market-pay.index')}}"><i class="si si-wallet"></i><span
                class="sidebar-mini-hide">Thanh toán</span></a>
        </li> --}}
        <li>
            <a class="active" href="{{route('market-pay-online.index')}}"><i class="fa fa-shopping-cart"></i><span
                class="sidebar-mini-hide">Đơn online</span></a>
        </li>
        <li>
            <a class="active" href="{{route('market-daily-sales.index')}}"><i class="fa fa-legal"></i><span
                class="sidebar-mini-hide">Chốt đơn ngày </span></a>
        </li>
        <li>
            <a class="active" href="{{route('market-pay-detail.index')}}"><i class="fa fa-stack-exchange"></i><span
                class="sidebar-mini-hide">Chi tiết đơn</span></a>
        </li>
        <li>
            <a class="active" href="{{route('market-daily-sales.show')}}"><i class="fa fa-line-chart"></i><span
                class="sidebar-mini-hide">Doanh thu</span></a>
        </li>
        <li>
            <a class="active" href="{{route('product.index')}}"><i class="fa fa-shopping-bag"></i><span
                class="sidebar-mini-hide">Sản phẩm</span></a>
            </li>
            @if(Auth::user()->is_admin == 1)
                <li>
                    <a class="active" href="{{route('category.index')}}"><i
                        class="fa fa-list-alt"></i><span class="sidebar-mini-hide">Danh mục</span></a>
                    </li>
                    <li>
                        <a class="active" href="{{route('users.index')}}"><i
                            class="fa fa-user"></i><span class="sidebar-mini-hide">Người dùng</span></a>
                        </li>
            @endif            
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- Sidebar Content -->
        </nav>
