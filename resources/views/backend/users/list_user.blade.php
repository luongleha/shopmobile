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
                            <h2 class="content-heading" style="padding-top: 15px;">Danh sách nhân viên</h2>
                            <!-- Dynamic Table Full Pagination -->
                            <div class="block">

                            <div class="block-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="push">
                                        <label style="font-weight: 600; font-size: 18px; color:black;">Tổng : {{$count}} nhân viên.&emsp;</label>
                                        <button type="button" class="btn btn-primary" id="create-user-btn"
                                            data-toggle="modal" data-target="#createUser">Tạo nhân viên
                                        </button>
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
                                    <input type="text" class="form-controller form-control form-control-sm" id="search" name="search" style="height: calc(1.428572em + .857143rem + 2px);" placeholder="tìm kiếm theo tên hoặc email...">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="choose"><b>Chức vụ</b></div>
                                <div style="display: flex; align-items: flex-end;">
                                    <select class="browser-default custom-select" id="is_admin">
                                        <option value="0">Tất cả</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div><b>Ngày bắt đầu</b></div>
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
                <div id="user-append">
                    @include('backend.users.list_user_table')
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
    <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog main-create" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hồ sơ nhân viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    {{-- <form class="js-validation-bootstrap"> --}}
                    <form>
                                <div class="form-group">
                                            <label class="col-form-label" for="val-currency">
                                            Tên nhân viên
                                                <spanclass="text-danger">*</span></label>
                                            <div>
                                                <input type="text" class="form-control create-name"
                                                       name="val-number" placeholder="Điền đầy đủ họ tên">
                                            </div>
                                </div>

                                <div class="form-group">
                                            <label class="col-form-label" for="val-currency">Email<span
                                                    class="text-danger">*</span></label>
                                            <div>
                                                <input type="email" class="form-control create-email"
                                                       name="email" placeholder="Điền vào email 'vd: @gmail'">
                                            </div>
                                </div>

                                <div class="form-group">
                                            <label class="col-form-label" for="val-currency">Mật khẩu<span
                                                    class="text-danger">*</span></label>
                                            <div>
                                                <input type="password" name="password" class="form-control create-pass"
                                                       name="password" placeholder="************">
                                            </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="val-select2">Chức vụ<span
                                            class="text-danger">*</span></label>
                                    <div class="form-input-create-category">
                                        <select class="js-select2 form-control create-is-admin" style="width: 100%;" data-placeholder="--Chọn quyền---">
                                            <option></option>
                                            <option value="1">Admin</option>
                                            <option value="2">User</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile" class="col-form-label">Hình ảnh nhân viên
                                    <span class="text-danger">*</span></label>
                                    <span class="col-form-label fa fa-info-circle pl-2" data-toggle="popover" data-placement="top" data-content="Hệ thống sẽ dùng làm ảnh hồ sơ nhân viên"></span>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input create-image"
                                               id="example-file-multiple-input-custom"
                                               name="example-file-multiple-input-custom" data-toggle="custom-file-input"
                                               name="image[]">
                                        <label class="custom-file-label" for="example-file-multiple-input-custom">Chọn
                                            ảnh</label>
                                    </div>
                                </div>
                    </form>
                    <span id="uploaded_image"></span>
                </div>
                <div class="modal-footer" style="justify-content: center">
                    <button type="button" class="btn btn-danger create-buff-cmt-cancel" data-dismiss="modal">Huỷ
                    </button>
                    <button type="button" class="btn btn-primary create-user-submit">Tạo</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editFacebookMarket" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                                
                    </form>
                </div>
                <div class="modal-footer" style="justify-content: center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    {{--                    <button type="button" class="btn btn-success edit-buff-submit" data-dismiss="modal">Thực hiện</button>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog main-create" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nội dung đăng bán sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                            <form>
                                <div class="form-group" style="display: none;">
                                            <div>
                                                <input type="text" class="form-control edit-id-user">
                                            </div>
                                </div>
                                <div class="form-group">
                                            <label class="col-form-label" for="val-currency">
                                            Tên nhân viên
                                                <span class="text-danger">*</span></label>
                                            <div>
                                                <input type="text" class="form-control edit-name"
                                                       name="val-number" placeholder="Điền đầy đủ họ tên">
                                            </div>
                                </div>

                                <div class="form-group">
                                            <label class="col-form-label" for="val-currency">Email<span
                                                    class="text-danger">*</span></label>
                                            <div>
                                                <input type="email" class="form-control edit-email"
                                                       name="email" placeholder="Điền vào email 'vd: @gmail'">
                                            </div>
                                </div>

                                <div class="form-group">
                                            <label class="col-form-label" for="val-currency">Mật khẩu<span
                                                    class="text-danger">*</span></label>
                                            <div>
                                                <input type="password" class="form-control edit-pass"
                                                       name="password" placeholder="************">
                                            </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="val-select2">Chức vụ<span
                                            class="text-danger">*</span></label>
                                    <div class="form-input-create-category">
                                        <select class="js-select2 form-control edit-is-admin" style="width: 100%;" data-placeholder="--Chọn quyền---">
                                            <option></option>
                                            <option value="1">Admin</option>
                                            <option value="2">User</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile" class="col-form-label">Hình ảnh nhân viên
                                    <span class="text-danger">*</span></label>
                                    <span class="col-form-label fa fa-info-circle pl-2" data-toggle="popover" data-placement="top" data-content="Hệ thống sẽ dùng làm ảnh hồ sơ nhân viên"></span>
                                    <div class="edit-file row" style="height: 112px;">
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input edit-image-user"
                                               id="example-file-multiple-input-custom"
                                               name="example-file-multiple-input-custom" data-toggle="custom-file-input"
                                               name="image[]">
                                        <label class="custom-file-label" for="example-file-multiple-input-custom">Chọn
                                            ảnh</label>
                                    </div>
                                </div>
                    </form>
                    <span id="uploaded_image"></span>
                </div>
                <div class="modal-footer" style="justify-content: center">
                    <button type="button" class="btn btn-danger create-buff-cmt-cancel" data-dismiss="modal">Huỷ
                    </button>
                    <button type="button" class="btn btn-primary edit-user-submit">Sửa</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận xoá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 0">
                        <span>Bạn có chắc là muốn xoá nhân viên này?</span>
                    </div>
                    {{--                    <div class="row" style="margin: 15px 0 0">--}}
                    {{--                        <strong>Lưu ý:&#160;</strong><span>Chỉ xoá khi đơn hàng có trạng thái là&#160;</span>--}}
                    {{--                        <strong>Chờ xử lý</strong>--}}
                    {{--                    </div>--}}
                </div>
                <input type="hidden" class="delete-user-id">
                <div class="modal-footer" style="justify-content: center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ bỏ</button>
                    <button type="button" class="btn btn-success delete-user-submit" data-dismiss="modal">Thực hiện
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
    <script src="{{asset('js/components/user.js')}}"></script>
@endsection
