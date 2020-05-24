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

    ///////CREATE////////

    $('body').on('click', '.create-daily-sale-submit', function () {
        let full_path = main_url + '/admin/market-daily-sales/create';
        var formData = new FormData();
        formData.append('total_quantity', $('.create-total-quantity').val());
        formData.append('total_money', $('.create-total-money').val());
        console.log($('.create-total-quantity').val());
        if ($('.create-total-quantity').val() !== '' && $('.create-total-money').val() !== '' ) {
            $.ajax({
                type: "POST",
                url: full_path,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {

                // $("#result").text(data);
                window.location.href = '/admin/market-daily-sales/show';
                toastr.success('Chốt thành công');
            },
            error: function (e) {

                // $("#result").text(e.responseText);
                toastr.error('Lỗi! Không thể chốt');

                    }
                });
            }
        });
    ///////PAGINATE////////
//     $(document).on('click', '.pagination a', function(event){
//       event.preventDefault(); 
//       var page = $(this).attr('href').split('page=')[1];
//       curPage = $(this).text();
//       fetch_data(page);
//   });

//     function fetch_data(page)
//     {
//       $.ajax({
//        url:"/admin/market-daily-sales/list?page="+page,
//        success:function(data)
//        {
//         $('#fb-market-append').empty();
//         $('#fb-market-append').html(data.data);
//         addOrdinalNumber('.table-daily-sales-market');
//     }
// });
//   }
    ///////END-PAGINATE////////
});