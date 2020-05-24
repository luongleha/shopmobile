@extends('backend.app')

@section('header')
    <link href="{{asset('css/components/fb_market.css')}}" rel="stylesheet">
@endsection

@section('content')
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="card">
                    <main id="main-container">

                        <!-- Page Content -->
                        <div class="content">
                            <h2 class="content-heading"  style="padding-top: 15px;">Chi tiết thanh toán</h2>
                            <!-- Dynamic Table Full Pagination -->
                            <div class="block">

                            <div class="block-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="push">
                                        <label style="font-weight: 600; font-size: 18px; color:black;">Tổng : {{$count}} bill.&emsp;</label>
                                        <button type="button" class="btn btn-success choose-filter" data-toggle="tooltip" type="button" data-original-title="" title="">Tìm kiếm
                                        </button>
                                        </div>
                                    </div>
                                </div>
                          <div class="row  border-bottom form-filter form-filters" style="margin-top: 1%; padding-bottom: 5px;">
                        <div class="col-md-12" style="display: flex; flex-wrap: wrap; flex-grow: 1">
                            <div class="col-md-3">
                                <div class="input-group search"><b>Tìm kiếm:</b></div>
                                <div>
                                    <input type="text" class="form-controller form-control form-control-sm" id="search" name="search" style="height: calc(1.428572em + .857143rem + 2px);" placeholder="nhập tìm kiếmm">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div><b>Ngày thanh toán</b></div>
                                <div>
                                    <input class="form-control" type="date" id="time-start" name="trip-start"
                                    min="2018-01-01"
                                    max="3018-12-31">
                                </div>
                            </div>
                            
                            <div class="col-md-1 row">
                                <div class="col-md-12">
                                    <div class="row" style="margin-top: 20px; justify-content: center">
                                        <div class="btn-group btn-group-fn" role="group">
                                            <button type="button" class="btn btn-success search-log" id="load"
                                            data-loading-text="<i class='fa fa-spinner fa-spin' style='padding: 5px;'></i>"><i class="fa fa-paper-plane"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" id="clear-filter"><i class="fa fa-times mr-5"></i></button>
                                    </div>
                                </div>
                            </div>
                            </div>
                </div>
            </div>
                      </div>

                      
            

            <div class="card-body">
                <div id="fb-market-append">
                    @include('backend.market_pay_online.list_pay_online_product_table')
                </div>
            </div>

        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- END Page Content -->

</main>
</div>
</div>
</div>
@endsection

@section('modal')
    <div class="modal fade" id="billDetailMarket" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog main-create" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bill lên đơn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    {{-- <form class="js-validation-bootstrap"> --}}
                    <form>
                        <div class="form-group" style="display: none;">
                                    <div>
                                        <input type="text" class="form-control show-id-bill">
                                    </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h2>Thông tin khách hàng</h2>
                                <div class="form-group">
                                            <label class="col-form-label" for="val-currency">
                                            Tên khách hàng</label>
                                            <div>
                                                <input type="text" class="form-control show-name"
                                                       name="val-number" disabled>
                                            </div>
                                </div>

                                <div class="form-group">
                                            <label class="col-form-label" for="val-currency">Email</label>
                                            <div>
                                                <input type="email" class="form-control show-email"
                                                       name="email" disabled>
                                            </div>
                                </div>

                                <div class="form-group">
                                            <label class="col-form-label" for="val-currency">
                                            Số điện thoại</label>
                                            <div>
                                                <input type="text" class="form-control show-phone" name="signnature-available" list="signnature-available" disabled>
                                                <datalist id="signnature-available">
                                                    {{-- @foreach($userinfos as $userinfo)
                                                      <option value="{{$userinfo->phone}}">
                                                    @endforeach --}}
                                                </datalist>
                                            </div>
                                </div>

                                <div class="form-group">
                                            <label class="col-form-label" for="val-currency">
                                            Địa chỉ</label>
                                            <div>
                                                <input type="text" class="form-control show-address"
                                                       name="val-number" disabled>
                                            </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2>Sản phẩm</h2>
                        <div class="cart_items">
                            <ul class="cart_list">
                                {{-- <li class="cart_item clearfix">
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div style="width: 150px;" class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Mã sản phẩm</div>
                                            <input type="text" class="form-control show-id-product"
                                                       name="val-number" value="" disabled>
                                        </div>
                                        <div style="width: 150px;" class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Tên sản phẩm</div>
                                            <input type="text" class="form-control show-name-product"
                                                       name="val-number" value="" disabled>
                                        </div>
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Số lượng</div>
                                            <input type="text" class="form-control show-qty-product"
                                                       name="val-number" value="" disabled>
                                            <div class="cart_item_text"></div>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_title">Giá</div>
                                            <input type="text" class="form-control show-price-product"
                                                       name="val-number" value="" disabled>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Tổng tiền</div>
                                            <input type="text" class="form-control show-totalprice-product"
                                                       name="val-number" value="" disabled>
                                        </div>
                                    </div>
                                </li>
                                <br> --}}
                            </ul>
                        </div>

                        <!-- Order Total -->
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title"><b>Tổng số lượng:</b></div>
                                <div class="order_total_amount"><b class="show-totalnum-product"></b><b>&emsp;Chiếc</b></div>
                            </div>
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title"><b>Tổng tiền thanh toán (Đã bao gồm 10% Thuế VAT):</b></div>
                                <div class="order_total_amount"><b class="show-totalpay-product" style="color: red"></b><b style="color: red">&emsp;VND</b></div>
                            </div>
                        </div>
                        <br>
                                <h4 style="float: right;">Bill online chờ chốt đơn</h4>

                            </div>
                        </div>
                                
                    </form>
                </div>
                <div class="modal-footer" style="justify-content: center">
                    <button type="button" class="btn btn-danger create-buff-cmt-cancel" data-dismiss="modal">Huỷ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmOnlineMarket" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận bill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 0">
                        <span>Khi ấn xác nhận bill sẽ được vận đơn cho nhà vận chuyển</span>
                    </div>
                    {{--                    <div class="row" style="margin: 15px 0 0">--}}
                    {{--                        <strong>Lưu ý:&#160;</strong><span>Chỉ xoá khi đơn hàng có trạng thái là&#160;</span>--}}
                    {{--                        <strong>Chờ xử lý</strong>--}}
                    {{--                    </div>--}}
                </div>
                <input type="hidden" class="confirm-id">
                <div class="modal-footer" style="justify-content: center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ bỏ</button>
                    <button type="button" class="btn btn-success confirm-submit" data-dismiss="modal">Thực hiện
                    </button>
                </div>
            </div>
        </div>
    </div>
    <style>
        .count-length {
            /*display: none;*/
        }
    </style>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

    <!-- Page JS Code -->
    <script src="{{asset('assets/js/pages/be_comp_calendar.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery-auto-complete/jquery.auto-complete.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/masked-inputs/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/dropzonejs/dropzone.min.j')}}s"></script>
    <script src="{{asset('assets/js/plugins/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery-validation/additional-methods.js')}}"></script>
    <script src="{{asset('assets/js/poment/poment.js')}}"></script>
    <script src="{{asset('assets/js/poment/moment-with-locales.min.js')}}"></script>

    <!-- Page JS Code -->
    <script src="{{asset('assets/js/pages/be_forms_validation.min.js')}}"></script>

    <!-- Page JS Code -->
    <script src="{{asset('assets/js/pages/be_forms_plugins.min.js')}}"></script>
    <script>jQuery(function () {
            Codebase.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'tags-inputs', 'slick']);
        });</script>
    <script src="{{asset('js/components/pay_online.js')}}"></script>
@endsection
