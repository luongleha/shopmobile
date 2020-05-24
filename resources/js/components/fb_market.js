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
    $('body').on('click', '#create-fb-market-btn', function () {
        cleanFormCreateFacebookMarket();
    });

    $('body').on('click', '.create-fb-market-submit', function () {
        let full_path = main_url + '/admin/product-market/create';
        var formData = new FormData();
        formData.append('name', $('.create-name').val());
        formData.append('origin_price', $('.create-price_origin').val());
        formData.append('sale_price', $('.create-price_sale').val());
        formData.append('category', $('.create-category').val());
        formData.append('quantity', $('.create-quantity').val());
        formData.append('content', $('.create-content').val());
        formData.append('status', $('.create-status').val());

        if($('.create-hot').prop("checked") == true){
                $('.create-hot').attr('value', 1);
            }
            else if($('.create-hot').prop("checked") == false){
                $('.create-hot').attr('value', 0);
            }
        formData.append('hot', $('.create-hot').val());

        var $image = $('.create-image').prop('files');
        var $length = $image.length;
        for (var $i = 0; $i < $length; $i++){
            formData.append('image[]', $image[$i]);
        }
        console.log($('.create-image').prop('files'));
        if ($('.create-name').val() !== '' && $('.create-price_origin').val() !== ''
            && $('.create-price_sale').val() !== '' && $('.create-category').val() !== '' && $('.create-content').val() !== '' 
            && $('.create-image').val() !== '' && $('.create-status').val() !== '') {
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
                $('#createFacebookMarket').modal('toggle');
                toastr.success('Tạo đơn hàng market thành công');
                $('#fb-market-append').html(data.data);
                addOrdinalNumber('.table-fb-market');

            },
            error: function (e) {

                // $("#result").text(e.responseText);
                toastr.error('Lỗi! Không thể tạo đơn hàng market');

            }
        });
    } else {
        if ($('.create-name').val() === '') {
            toastr.error('Vui lòng nhập vào tên');
        }
        if ($('.create-price_origin').val() === '') {
            toastr.error('Vui lòng nhập vào giá gốc sản phẩm');
        }
        if (isNaN($('.create-price_origin').val())) {
            toastr.error('Vui lòng nhập vào giá gốc sản phẩm bằng số');
        }
        if ($('.create-price_sale').val() === '') {
            toastr.error('Vui lòng nhập vào giá đã giảm của sản phẩm');
        }
        if (isNaN($('.create-price_sale').val())) {
            toastr.error('Vui lòng nhập vào giá đã giảm của sản phẩm bằng số');
        }
        if ($('.create-content').val() === '') {
            toastr.error('Vui lòng nhập mô tả');
        }
        if ($('.create-image').val() === '') {
            toastr.error('Vui lòng chọn ảnh sản phẩm');
        }
        if ($('.create-status').val() == '') {
            toastr.error('Vui lòng chọn trạng thái sản phẩm');
        }
        if ($('.create-category').val() == '') {
            toastr.error('Vui lòng chọn danh mục sản phẩm');
        }
    }
});
    ///////END-CREATE////////

//     ///////*************************************************////////

//     ///////EDIT////////
//     $('body').on('click', '.edit-fb-market-btn', function () {
//         let id = $(this).attr('data-id');
//         let full_path = main_url + '/product-market/detail';
//         $.get(full_path, {id: id}, function (data) {
//             // if (data.code && data.code === 200) {
//                 $('.edit-titile').val(data.fbm.title);
//                 $('.edit-description').val(data.fbm.description);
//                 $('.edit-price_product').val(data.fbm.price);
//                 $('.edit-category').val(data.fbm.category_id);
//                 $('.edit-start_order').val(data.fbm.start_date);
//                 $('.edit-end_of_order').val(data.fbm.end_date);
//                 $('.edit-delay').val(data.fbm.delay);
//                 var $item = data.arrimg;
//                 console.log($item);
//                 var $length = $item.length;
//                 for (var $i = 0; $i < $length; $i++){
//                     // $('.edit-image').src = ('item[]', $item[$i]);
//                     $('.edit-file').append(`<img src="/${$item[$i]}" style="width: 100px; height: 100px; padding-left: 10px; padding-right: 10px; margin-bottom: 10px;" class="edit-image">`);
//                 }
//                 $('.edit-location').val(data.fbm.location);
//                 $('.edit-note').val(data.fbm.note);
//                 // var $acc = data.arrpost;
//                 // console.log($acc);
//                 // $('.edit-account').select2({$acc: data});
//                 var $acc = data.arrpost;
//                 var $length = $acc.length;
//                 var $a = [];
//                 for (var $i = 0; $i < $length; $i++){
//                     $a.push({ id: $i, text: $acc[$i] });
//                 }
//                 var data = $a;

//                 $(".edit-account").select2({
//                     data: data
//                 });

//                 // console.log();
//             // }
//         });
//     });

//     $('#editFacebookMarket').on('hidden.bs.modal', function() {
//         cleanFormEditFacebookMarket();
//     });
//     ///////END-EDIT////////

    ///////AGAIN-CREATE////////
    $('body').on('click', '.create-again-fb-market-btn', function () {
        let id = $(this).attr('data-id');     
        $('.create-again-id').val(id);
        let full_path = main_url + '/admin/product-market/detail';
        $.get(full_path, {id: id}, function (data) {
            // if (data.code && data.code === 200) {
                $('.create-again-name').val(data.fbm.name);
                $('.create-again-price_origin').val(data.fbm.origin_price);
                $('.create-again-price_sale').val(data.fbm.sale_price);
                $('.create-again-quantity').val(data.fbm.quantity);
                $('.create-again-content').val(data.fbm.content);
                $('.create-again-status').val(data.fbm.status);
                var $item = data.arrimg;
                var $length = $item.length;
                for (var $i = 0; $i < $length; $i++){
                    // $('.edit-image').src = ('item[]', $item[$i]);
                    $('.create-again-file').append(`<div class="col-md-1 dbclick-delete-img"><input type="text" class=" custom-file-input image-add-again" id="example-file-multiple-input-custom" data-toggle="custom-file-input" name="imagelink[]" value="${$item[$i]}" style="display: none"><img src="/${$item[$i]}" style="width: 100px; height: 100px; padding-left: 10px; padding-right: 10px; margin-bottom: 10px;" class="edit-image"></div>`);
                    console.log($item[$i]);
                }
        });
        cleanFormCreateAgainFacebookMarket();
    });

    $('body').on('click', '.create-again-fb-market-submit', function () {
        let full_path = main_url + '/admin/product-market/create-again';
        var formData = new FormData();
        formData.append('id', $('.create-again-id').val());
        // console.log($('.create-again-id').val());
        formData.append('name', $('.create-again-name').val());
        formData.append('origin_price', $('.create-again-price_origin').val());
        formData.append('sale_price', $('.create-again-price_sale').val());
        formData.append('category', $('.create-again-category').val());
        formData.append('quantity', $('.create-again-quantity').val());
        formData.append('content', $('.create-again-content').val());
        formData.append('status', $('.create-again-status').val());

        if($('.edit-hot').prop("checked") == true){
                $('.edit-hot').attr('value', 1);
            }
            else if($('.edit-hot').prop("checked") == false){
                $('.edit-hot').attr('value', 0);
            }
        formData.append('hot', $('.edit-hot').val());
        var $image = $('.create-again-image').prop('files');
        var $length = $image.length;
        for (var $i = 0; $i < $length; $i++){
            formData.append('image[]', $image[$i]);
        }
        $('.image-add-again').each(function(){
            formData.append('imagelink[]', $(this).val());
        });
        
        if ($('.create-again-name').val() !== '' && $('.create-again-price_origin').val() !== ''
            && $('.create-again-price_sale').val() !== '' && $('.create-again-category').val() !== '' 
            && $('.create-again-content').val() !== '' 
            && $('.create-again-status').val() !== '' && $('.create-again-image').val() !== '') {
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
                $('#againcreateFacebookMarket').modal('toggle');
                toastr.success('Tạo đơn hàng market thành công');
                $('#fb-market-append').html(data.data);
                addOrdinalNumber('.table-fb-market');

            },
            error: function (e) {

                // $("#result").text(e.responseText);
                toastr.error('Lỗi! Không thể tạo đơn hàng market');

            }
        });
    } else {
        if ($('.create-again-name').val() === '') {
            toastr.error('Vui lòng nhập vào tên');
        }
        if ($('.create-again-price_origin').val() === '') {
            toastr.error('Vui lòng nhập vào giá gốc sản phẩm');
        }
        if (isNaN($('.create-again-price_origin').val())) {
            toastr.error('Vui lòng nhập vào giá gốc sản phẩm bằng số');
        }
        if ($('.create-again-price_sale').val() === '') {
            toastr.error('Vui lòng nhập vào giá đã giảm của sản phẩm');
        }
        if (isNaN($('.create-again-price_sale').val())) {
            toastr.error('Vui lòng nhập vào giá đã giảm của sản phẩm bằng số');
        }
        if ($('.create-again-content').val() === '') {
            toastr.error('Vui lòng nhập mô tả');
        }
        // if ($('.create-again-image').val() === '') {
        //     toastr.error('Vui lòng chọn ảnh sản phẩm');
        // }
        if ($('.create-again-status').val() == '') {
            toastr.error('Vui lòng chọn trạng thái sản phẩm');
        }
        if ($('.create-again-category').val() == '') {
            toastr.error('Vui lòng chọn danh mục sản phẩm');
        }
    }
});

    $('body').on('dblclick', '.dbclick-delete-img', function () {
        $(this).remove();
    });

    ///////END-AGAIN-CREATE////////


//     // $('body').on('click', '.history-fb-market-btn', function () {
//     //     let id = $(this).attr('data-id');
//     //     // return false;
//     //     // store['element'] = $(this);
//     //     let full_path = main_url + '/product-market/list';
//     //     $.get(full_path, {post_id: id}, function (data) {
//     //         store['post_id'] = id;
//     //     });
//     // });

//     $('body').on('click', '.log-seed-cmt-btn', function () {
//         let id = $(this).attr('data-id');
//         let full_path = main_url + '/facebook-history/history';
//         $.get(full_path, {id: id}, function (data) {
//             $('#log-seed-comment-append').html(data.data);
//             addOrdinalNumber('.table-log-seed-cmt');
//         })
//     });

//     $('body').on('click', '.clear-account', function () {
//         $('.create-account').val(null).trigger('change');
//         $('.create-again-account').val(null).trigger('change');
//     });

//     $('body').on('click', '.clear-time', function () {
//         $('.create-start_order').val('');
//         $('.create-end_of_order').val('');
//         $('.create-again-start_order').val('');
//         $('.create-again-end_of_order').val('');
//     });

//     $('body').on('click', '.clearitemimg', function () {
//         $('.create-again-file').remove();
//     });

//     $('body').on('dblclick', '.edit-image', function () {
//         $(this).remove();
//     });

//     ///////LOG////////

//     $('body').on('keyup', '#log-seed-search', function () {
//         let limit = $('.select-log-view').val();
//         let id = store['id'];
//         let post_id = $(this).val();
//         let full_path = main_url + '/facebook-history/history';
//         $.get(full_path, {id: id, post_id: post_id, limit: limit}, function (data) {
//             $('#log-seed-comment-append').html(data.data);
//             addOrdinalNumber('.table-log-seed-cmt');
//             paginate();
//         })
//     });

//     $('body').on('change', '.select-log-view', function () {
//         let limit = $(this).val();
//         let id = store['id'];
//         let post_id = $('#log-seed-search').val();
//         let full_path = main_url + '/product-history/history/history';
//         $.get(full_path, {id: id, post_id: post_id, limit: limit}, function (data) {
//             $('#log-seed-comment-append').html(data.data);
//             addOrdinalNumber('.table-log-seed-cmt');
//             paginate();
//         });
//     });
//     ///////END-LOG////////

    ///////*************************************************////////

    ///////DELETE////////
    $('body').on('click', '.delete-fb-market-btn', function () {
        $('.delete-fb-market-id').val($(this).attr('data-id'));
    });

    $('body').on('click', '.delete-fb-market-submit', function () {
        let id = $('.delete-fb-market-id').val();
        let full_path = main_url + '/admin/product-market/delete';
        $.post(full_path, {id: id}, function (data) {
            if(data.code && data.code === 200) {
                let trow = $(store['element']).closest('tr');
                let full_path =  main_url + '/admin/product-market/list?page=' + (curPage);
                console.log(full_path);
                $(trow).remove();
                $.get(full_path, function (data) {
                    if (data.code && data.code === 200) {
                        toastr.success('Xoá đơn hàng thành công');
                        $('#fb-market-append').html(data.data);
                        addOrdinalNumber('.table-fb-market');
                    } else {
                        toastr.error('Lỗi! Không thể xoá được đơn hàng');
                    }
                });
            } else {
                toastr.error('Lỗi! Không thể xoá được đơn hàng');
            }
        });
    });
    ///////END-DELETE////////

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
       url:"/admin/product-market/list?page="+page,
       success:function(data)
       {
        $('#fb-market-append').empty();
        $('#fb-market-append').html(data.data);
        addOrdinalNumber('.table-fb-market');
    }
});
  }

    ///////END-PAGINATE////////

    ///////*************************************************////////

    ///////SEARCH////////
    $('#search').on('keyup',function(){
        let full_path = main_url + '/admin/product-market/search';
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

    $('body').on('keyup', '#cate', function () {
        search();
    });

    $('body').on('keyup', '#status', function () {
        search();
    });

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
        let full_path = main_url + '/admin/product-market/logsearch';
        var cate = $('#cate').val();
        var status = $('#status').val();
        // var account = $('#account').val();
        var time_start = $('#time-start').val();
        $.ajax({
            type : 'get',
            url : full_path,
            data:{cate: cate, status: status, time_start: time_start},
            success:function(data){
                console.log(data);
                $('tbody').html(data);
            }
        });
    }

    // $('#cate').on('change',function(){
    //     let full_path = main_url + '/product-market/logsearch';
    //     var $id = $(this).val();
    //     $.ajax({
    //         type : 'get',
    //         url : full_path,
    //         data:{'search':$id},
    //         success:function(data){
    //             console.log(data);
    //             $('tbody').html(data);
    //         }
    //     });
    // });

    // $('#time-start').on('change',function(){
    //     let full_path = main_url + '/product-market/logsearch';
    //     var $time_start = $(this).val();
    //     $.ajax({
    //         type : 'get',
    //         url : full_path,
    //         data:{'search':$time_start},
    //         success:function(data){
    //             console.log(data);
    //             $('tbody').html(data);
    //         }
    //     });
    // });

    
    // $('#time-end').on('change',function(){
    //     let full_path = main_url + '/product-market/logsearch';
    //     var $time_end = $(this).val();
    //     console.log();
    //     $.ajax({
    //         type : 'get',
    //         url : full_path,
    //         data:{'search':$time_end},
    //         success:function(data){
    //             console.log(data);
    //             $('tbody').html(data);
    //         }
    //     });
    // });

    $('body').on('click', '#clear-filter', function () {
        $('#cate').val(0);
        $('#status').val(0);
        $('#account').val(0);
        $('#time-start').val('');
        search();
    });
    ///////END-SEARCH////////

//     ///////*************************************************////////

//     ///////SHOW-IMAGE-CREATE-POST////////
//     function formatState (state) {
//     // console.log(state);
//     let user_id = $('.option_create_value').val();
//     if (!state.id) { return state.text; }
//     var $state = $(
//         '<span><img src="http://graph.facebook.com/'+state.id+'/picture?type=large" style="width: 35px;" class="img-flag" /> ' + state.text +     '</span>'
//         );
//     return $state;
// };

// $(".create-account").select2({
//   templateResult: formatState

// });

// $(".create-again-account").select2({
//   templateResult: formatState

// });
//     ///////END-SHOW-IMAGE-CREATE-POST////////

///////DELETE-MULTIPE-AND-HIDDEN-SHOOSE////////
    $('#master').on('click', function(e) {
       if($(this).is(':checked',true))  
       {
        $(".sub_chk").prop('checked', true);  
    } else {  
        $(".sub_chk").prop('checked',false);  
    }  
});


    $('.delete_all').on('click', function(e) {


        var allVals = [];  
        $(".sub_chk:checked").each(function() {  
            allVals.push($(this).attr('data-id'));
        });  


        if(allVals.length <=0)  
        {  
            toastr.success('Hãy kích chọn đơn hàng muốn xóa');  
        }  else {  


            var check = confirm("Bạn chắc chắn muốn xóa những đơn hàng này?");  
            if(check == true){  


                var join_selected_values = allVals.join(","); 


                $.ajax({
                    url: $(this).data('url'),
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'ids='+join_selected_values,
                    success: function (data) {
                        if (data['success']) {
                            $(".sub_chk:checked").each(function() {  
                                $(this).parents("tr").remove();
                            });
                            toastr.success('Xóa đơn hàng thành công');  
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });


                $.each(allVals, function( index, value ) {
                  $('table tr').filter("[data-row-id='" + value + "']").remove();
              });
            }  
        }  
    });

    $(document).on('confirm', function (e) {
        var ele = e.target;
        e.preventDefault();


        $.ajax({
            url: ele.href,
            type: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if (data['success']) {
                    $("#" + data['tr']).slideUp("slow");
                    alert(data['success']);
                } else if (data['error']) {
                    alert(data['error']);
                } else {
                    alert('Whoops Something went wrong!!');
                }
            },
            error: function (data) {
                alert(data.responseText);
            }
        });


        return false;
    });

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
    ///////END-DELETE-MULTIPE-AND-HIDDEN-SHOOSE////////



});

function cleanFormCreateFacebookMarket() {
    $('.create-titile').val('Thanh lý laptop {giá cực rẻ | giá rẻ như cho | giá ưu đãi nhất} ở Hà Nội');
    $('.create-description').val('Bạn đang tìm kiếm { laptop giá rẻ | laptop giá cực rẻ}. Hãy tìm đến laptopxx, laptop tại đây {có giá cực rẻ | có giá như cho | rẻ không đâu bằng } nhất Hà Nội');
    $('.create-price_product').val('');
    $('.create-category').val(null).trigger('change');
    $('.create-time-now').prop("checked", true);
    $('.create-start_order').val('');
    $('.create-end_of_order').val('');
    $('.create-delay').val('30');
    $('.create-image').val('');
    $('.custom-file-label').text('');
    $('.create-location').val('');
    $('.create-account').val(null).trigger('change');
    $('.create-total').val(1).trigger('change');
    $('.create-signature').val('');
    $('.create-note').val('');
    $('.preview-category').text('');
    $('.preview-title').text('');
    $('.preview-location').text('');
    $('.preview-price').text('');
    $('.preview-description').text('');
    $('.preview-account').text('');
    $('.preview-img-account').attr("src", "");
    $('.img-fluid').attr('src', "");
    $('.preview-start-time').text('');
}

function cleanFormEditFacebookMarket() {
    $('.edit-titile').val('');
    $('.edit-description').val('');
    $('.edit-price_product').val('');
    $('.edit-category').prop("checked", false);
    $('.edit-start_order').val('');
    $('.edit-end_of_order').val('');
    $('.edit-delay').val('');
    $('.edit-file').text('');
    $('.edit-location').val('');
    $('.edit-account').text('');
    $('.edit-note').val('');
    $('.edit-titile').val('');
}

function cleanFormCreateAgainFacebookMarket() {
    $('.create-again-image').val('');
    $('.create-again-file').text('');
}
