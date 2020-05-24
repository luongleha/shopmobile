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
    $('body').on('click', '#create-user-btn', function () {
        cleanFormCreateUser();
    });

    $('body').on('click', '.create-user-submit', function () {
        let full_path = main_url + '/admin/users/create';
        var formData = new FormData();
        formData.append('name', $('.create-name').val());
        formData.append('email', $('.create-email').val());
        formData.append('pass', $('.create-pass').val());
        formData.append('is_admin', $('.create-is-admin').val());
        var $image = $('.create-image').prop('files');
        var $length = $image.length;
        for (var $i = 0; $i < $length; $i++){
            formData.append('image[]', $image[$i]);
        }
        console.log($('.create-image').prop('files'));
        if ($('.create-name').val() !== '' && $('.create-email').val() !== ''
            && $('.create-pass').val() !== '' && $('.create-is-admin').val() !== '' && $('.create-image').val() !== '') {
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
                $('#createUser').modal('toggle');
                toastr.success('Tạo đơn nhân viên thành công');
                $('#user-append').html(data.data);
                addOrdinalNumber('.table-user');

            },
            error: function (e) {

                // $("#result").text(e.responseText);
                toastr.error('Lỗi! Không thể tạo nhân viên');

            }
        });
    } else {
        if ($('.create-name').val() === '') {
            toastr.error('Vui lòng nhập vào tên nhân viên');
        }
        if ($('.create-email').val() === '') {
            toastr.error('Vui lòng nhập vào email nhân viên');
        }
        if ($('.create-pass').val() === '') {
            toastr.error('Vui lòng nhập vào mật khẩu');
        }
        if ($('.create-image').val() === '') {
            toastr.error('Vui lòng chọn ảnh nhân viên');
        }
        if ($('.create-is-admin').val() == '') {
            toastr.error('Vui lòng chọn chức vụ nhân viên');
        }
    }
});
    ///////END-CREATE////////

//     ///////*************************************************////////

//     ///////EDIT////////
//     $('body').on('click', '.edit-user-btn', function () {
//         let id = $(this).attr('data-id');
//         let full_path = main_url + '/users/detail';
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
    $('body').on('click', '.edit-user-btn', function () {
        let id = $(this).attr('data-id');
        $('.edit-id-user').val(id);
        let full_path = main_url + '/admin/users/detail';
        $.get(full_path, {id: id}, function (data) {
            // if (data.code && data.code === 200) {
                $('.edit-name').val(data.users.name);
                $('.edit-email').val(data.users.email);
                $('.edit-pass').val(data.users.password);
                // var acc = data.users.is_admin;
                // $("#showAcc").empty().trigger('change');
                // $(".edit-is-admin").select2({
                //     data: acc
                // });
                $('.edit-is-admin').val(data.users.is_admin);
                console.log($('.edit-is-admin').val());
                var $item = data.path;
                    $('.edit-file').append(`<div class="col-md-1 dbclick-delete-img"><input type="text" class=" custom-file-input image-add-again" id="example-file-multiple-input-custom" data-toggle="custom-file-input" name="imagelink[]" value="${$item}" style="display: none"><img src="/${$item}" style="width: 100px; height: 100px; padding-left: 10px; padding-right: 10px; margin-bottom: 10px;" class="edit-image"></div>`);
        });
        cleanFormEditUser();
    });

    $('body').on('click', '.edit-user-submit', function () {
        let full_path = main_url + '/admin/users/update';
        var formData = new FormData();
        formData.append('id', $('.edit-id-user').val());
        console.log($('.edit-id-user').val());
        formData.append('name', $('.edit-name').val());
        formData.append('email', $('.edit-email').val());
        formData.append('pass', $('.edit-pass').val());
        formData.append('is_admin', $('.edit-is-admin').val());
        var $image = $('.edit-image-user').prop('files');
        var $length = $image.length;
        for (var $i = 0; $i < $length; $i++){
            formData.append('image[]', $image[$i]);
        }
        console.log($('.edit-name').val(), $('.edit-email').val(), $('.edit-pass').val(), $('.edit-is-admin').val(), $('.edit-image-user').prop('files'));
        if ($('.edit-name').val() !== '' && $('.edit-email').val() !== ''
            && $('.edit-pass').val() !== '' && $('.edit-is-admin').val() !== '' && $('.edit-image-user').val() !== '') {
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
                $('#editUser').modal('toggle');
                toastr.success('Tạo đơn nhân viên thành công');
                $('#user-append').html(data.data);
                addOrdinalNumber('.table-user');

            },
            error: function (e) {

                // $("#result").text(e.responseText);
                toastr.error('Lỗi! Không thể tạo nhân viên');

            }
        });
    } else {
        if ($('.edit-name').val() === '') {
            toastr.error('Vui lòng nhập vào tên nhân viên');
        }
        if ($('.edit-email').val() === '') {
            toastr.error('Vui lòng nhập vào email nhân viên');
        }
        if ($('.edit-pass').val() === '') {
            toastr.error('Vui lòng nhập vào mật khẩu');
        }
        if ($('.edit-image-user').val() === '') {
            toastr.error('Vui lòng chọn ảnh nhân viên');
        }
        if ($('.edit-is-admin').val() == '') {
            toastr.error('Vui lòng chọn chức vụ nhân viên');
        }
    }
});

    $('body').on('dblclick', '.dbclick-delete-img', function () {
        $(this).remove();
    });

    ///////END-AGAIN-CREATE////////


//     // $('body').on('click', '.history-user-btn', function () {
//     //     let id = $(this).attr('data-id');
//     //     // return false;
//     //     // store['element'] = $(this);
//     //     let full_path = main_url + '/users/list';
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
//         let full_path = main_url + '/facebook-history/history/history';
//         $.get(full_path, {id: id, post_id: post_id, limit: limit}, function (data) {
//             $('#log-seed-comment-append').html(data.data);
//             addOrdinalNumber('.table-log-seed-cmt');
//             paginate();
//         });
//     });
//     ///////END-LOG////////

    ///////*************************************************////////

    ///////DELETE////////
    $('body').on('click', '.delete-user-btn', function () {
        $('.delete-user-id').val($(this).attr('data-id'));
    });

    $('body').on('click', '.delete-user-submit', function () {
        let id = $('.delete-user-id').val();
        let full_path = main_url + '/admin/users/delete';
        $.post(full_path, {id: id}, function (data) {
            if(data.code && data.code === 200) {
                let trow = $(store['element']).closest('tr');
                let full_path =  main_url + '/admin/users/list?page=' + (curPage);
                console.log(full_path);
                $(trow).remove();
                $.get(full_path, function (data) {
                    if (data.code && data.code === 200) {
                        toastr.success('Xoá đơn nhân viên thành công');
                        $('#user-append').html(data.data);
                        addOrdinalNumber('.table-user');
                    } else {
                        toastr.error('Lỗi! Không thể xoá được nhân viên');
                    }
                });
            } else {
                toastr.error('Lỗi! Không thể xoá được nhân viên');
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
       url:"/admin/users/list?page="+page,
       success:function(data)
       {
        $('#user-append').empty();
        $('#user-append').html(data.data);
        addOrdinalNumber('.table-user');
    }
});
  }

    ///////END-PAGINATE////////

    ///////*************************************************////////

    ///////SEARCH////////
    $('#search').on('keyup',function(){
        let full_path = main_url + '/admin/users/search';
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

    $('body').on('keyup', '#is_admin', function () {
        search();
    });

    $('body').on('change', '#time-start', function () {
        search();
    });

    $('body').on('click', '.search-log', function () {
        search();
    });

    function search() {
        let full_path = main_url + '/admin/users/logsearch';
        var is_admin = $('#is_admin').val();
        // var account = $('#account').val();
        var time_start = $('#time-start').val();
        $.ajax({
            type : 'get',
            url : full_path,
            data:{is_admin: is_admin, time_start: time_start},
            success:function(data){
                console.log(data);
                $('tbody').html(data);
            }
        });
    }

    $('body').on('click', '#clear-filter', function () {
        $('#is_admin').val(0);
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
            toastr.success('Hãy kích chọn nhân viên muốn xóa');  
        }  else {  


            var check = confirm("Bạn chắc chắn muốn xóa những nhân viên này?");  
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
                            toastr.success('Xóa đơn nhân viên công');  
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

function cleanFormCreateUser() {
    $('.create-name').val('');
    $('.create-email').val('');
    $('.create-pass').val('');
    $('.create-image').val('');
    $('.create-is-admin').val(null).trigger('change');
}

function cleanFormEditUser() {
    $('.edit-name').val('');
    $('.edit-email').val('');
    $('.edit-pass').val('');
    $('.edit-is-admin').val(null).trigger('change');
    $('.edit-image-user').val('');
    $('.edit-file').text('');
}
