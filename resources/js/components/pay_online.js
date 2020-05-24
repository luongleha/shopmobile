import toastr, {main_url} from './config';
import {addOrdinalNumber, addOrdinalNumberSearch, delay} from "./main";

let curPage;
let _ = require('lodash');
$(document).ready(function () {
    let store = [];
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ///////CONFIRM////////
    $('body').on('click', '.confirm-btn', function () {
        $('.confirm-id').val($(this).attr('data-id'));
    });

    $('body').on('click', '.confirm-submit', function () {
        let id = $('.confirm-id').val();
        let full_path = main_url + '/admin/market-pay-online/confirm';
        $.post(full_path, {id: id}, function (data) {
            if(data.code && data.code === 200) {
                let trow = $(store['element']).closest('tr');
                let full_path =  main_url + '/admin/market-pay-online/list?page=' + (curPage);
                console.log(full_path);
                $(trow).remove();
                $.get(full_path, function (data) {
                    if (data.code && data.code === 200) {
                        toastr.success('Vận đơn hàng thành công');
                        $('#fb-market-append').html(data.data);
                        addOrdinalNumber('.table-pay-online-market');
                    } else {
                        toastr.error('Lỗi! Không thể vận được đơn hàng');
                    }
                });
            } else {
                toastr.error('Lỗi! Không thể vận được đơn hàng');
            }
        });
    });
    ///////END-CONFIRM////////

    ///////SHOW////////
    $('body').on('click', '.show-market-btn', function () {
        let id = $(this).attr('data-id');
        console.log(id);     
        $('.show-id-bill').val(id);
        let full_path = main_url + '/admin/market-pay-online/detail';
        $.get(full_path, {id: id}, function (data) {
                $('.show-name').val(data.user.fullname);
                $('.show-email').val(data.user.email);
                $('.show-phone').val(data.user.phone);
                $('.show-address').val(data.user.address);
                $('.show-money-taken').val(data.bill.money_taken);
                $('.show-excess-cash').val(data.bill.excess_cash);
                // $('.show-id-product').val(data.product.id);
                // $('.show-name-product').val(data.product.name);
                // $('.show-qty-product').val(data.detail.quantity);
                // $('.show-price-product').val(data.product.sale_price);
                // $('.show-totalprice-product').val(data.detail.into_money);
                var $item = data.details;
                console.log($item);
                var $length = $item.length;
                for (var $i = 0; $i < $length; $i++){
                    console.log($item[0].into_money);
                    $('.cart_list').append(`<li class="cart_item clearfix">
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div style="width: 150px;" class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Mã sản phẩm</div>
                                            <input type="text" class="form-control show-id-product"
                                                       name="val-number" value="${$item[$i].product_id}" disabled>
                                        </div>
                                        <div style="width: 150px;" class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Tên sản phẩm</div>
                                            <input type="text" class="form-control show-name-product"
                                                       name="val-number" value="${$item[$i].product_id}" disabled>
                                        </div>
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Số lượng</div>
                                            <input type="text" class="form-control show-qty-product"
                                                       name="val-number" value="${$item[$i].quantity}" disabled>
                                            <div class="cart_item_text"></div>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_title">Giá</div>
                                            <input type="text" class="form-control show-price-product"
                                                       name="val-number" value="${$item[$i].into_money}" disabled>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Tổng tiền</div>
                                            <input type="text" class="form-control show-totalprice-product"
                                                       name="val-number" value="${$item[$i].quantity * $item[$i].into_money}" disabled>
                                        </div>
                                    </div>
                                </li><br>`);
                }
                $('.show-totalnum-product').text(data.bill.quantity_buy);
                var total_money = data.bill.total_money
                const formatter = new Intl.NumberFormat('vn-VN', {
                  style: 'currency',
                  currency: 'VND',
                  minimumFractionDigits: 0
                });

                var format_total_money = formatter.format(total_money);
                var format_d_total_money = format_total_money.replace(/\₫/g,'');
                $('.show-totalpay-product').text(format_d_total_money.replace(/\./g,','));
        });
        cleanFormShowBillMarket();
    });
    ///////END-SHOW////////

    ///////*************************************************////////

    ///////PAGINATE////////
    $(document).on('click', '.pagination a', function(event){
      event.preventDefault(); 
      var page = $(this).attr('href').split('page=')[1];
      curPage = $(this).text();
      fetch_data(page);
  });

    function fetch_data(page)
    {
      $.ajax({
       url:"/admin/market-pay-online/list?page="+page,
       success:function(data)
       {
        $('#fb-market-append').empty();
        $('#fb-market-append').html(data.data);
        addOrdinalNumber('.table-pay-online-market');
    }
});
  }

    ///////END-PAGINATE////////

    ///////*************************************************////////

    ///////SEARCH////////
    $('#search').on('keyup',function(){
        let full_path = main_url + '/admin/market-pay-online/search';
        var value = $(this).val();
        $.ajax({
            type : 'get',
            url : full_path,
            data:{value: value},
            success:function(data){
                console.log(data);
                $('tbody').html(data);
            }
        });
    });

    // $('body').on('keyup', '#cate', function () {
    //     search();
    // });

    // $('body').on('keyup', '#status', function () {
    //     search();
    // });

    // $('body').on('keyup', '#account', function () {
    //     search();
    // });

    $('body').on('change', '#time-start', function () {
        search();
    });

    $('body').on('click', '.search-log', function () {
        search();
    });

    function search() {
        let full_path = main_url + '/admin/market-pay-online/logsearch';
        // var cate = $('#cate').val();
        // var status = $('#status').val();
        // var account = $('#account').val();
        var time_start = $('#time-start').val();
        $.ajax({
            type : 'get',
            url : full_path,
            data:{time_start: time_start},
            success:function(data){
                console.log(data);
                $('tbody').html(data);
            }
        });
    }
    $('body').on('click', '#clear-filter', function () {
        $('#cate').val(0);
        $('#status').val(0);
        $('#account').val(0);
        $('#time-start').val('');
        search();
    });
    ///////END-SEARCH////////
    $(function() {
    // select the button to click, this can be any element not just a button
    $('.choose').click(function() {
        // select which info panel to show/hide.
        $('.thcheckboxs').toggle();
        $('.tdcheckboxs').toggle();
        $('.delete_alls').toggle();
        // hide any info panels that are not info1.
        $('.thcheckbox').not('.thcheckboxs').hide();
        $('.tdcheckbox').not('.tdcheckboxs').hide();
        $('.delete_all').not('.delete_alls').hide();
    });
    $('.choose-filter').click(function() {
        // select which info panel to show/hide.
        $('.form-filters').toggle();
        // hide any info panels that are not info1.
        $('.form-filter').not('.form-filters').hide();
    });                         
});

});

function cleanFormShowBillMarket() {
    $('.show-name').val('');
    $('.show-email').val('');
    $('.show-phone').val('');
    $('.show-address').val('');
    $('.show-money-taken').val('');
    $('.show-excess-cash').val('');
    $('.show-totalnum-product').text('');
    $('.show-totalpay-product').text('');
    $('.cart_list').text('')
}
