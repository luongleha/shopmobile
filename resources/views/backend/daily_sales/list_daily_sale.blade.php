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
                            <h2 class="content-heading"  style="padding-top: 15px;">Bill trong ngày</h2>
                            <!-- Dynamic Table Full Pagination -->
                            <div class="block">

                            <div class="block-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="push">
                                        <label style="font-weight: 600; font-size: 18px; color:black;">Tổng : {{$count}} bill.&emsp;</label>
                                        </div>
                                    </div>
                                </div>
                      </div>

            <div class="card-body">
                <div id="fb-market-append">
                    @include('backend.daily_sales.list_daily_sale_table')
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
    <script src="{{asset('js/components/daily_sale.js')}}"></script>
@endsection
