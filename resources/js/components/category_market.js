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
    $('body').on('click', '#create-cate-market-btn', function () {
        cleanFormCreateCategoryMarket();
    });

    $('body').on('click', '.create-cate-market-submit', function () {
        let full_path = main_url + '/admin/category-market/create';
        var formData = new FormData();
        formData.append('name', $('.create-name').val());
        var $image = $('.create-image').prop('files');
        var $length = $image.length;
        for (var $i = 0; $i < $length; $i++){
            formData.append('image[]', $image[$i]);
        }
        // formData.append('depth', $('.create-depth').val());
        formData.append('parent_id', $('.create-category').val());
        if ($('.create-name').val() !== '') {
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
                $('#createCategoryMarket').modal('toggle');
                toastr.success('Tạo danh mục thành công');
                $('#cate-market-append').html(data.data);
                addOrdinalNumber('.table-cate-market');

            },
            error: function (e) {

                // $("#result").text(e.responseText);
                toastr.error('Lỗi! Không thể tạo danh mục');

            }
        });
    } else {
        if ($('.create-name').val() === '') {
            toastr.error('Vui lòng nhập vào tên danh mục');
        }
    }
});
    ///////END-CREATE////////

//     ///////*************************************************////////

    ///////AGAIN-CREATE////////
    $('body').on('click', '.edit-cate-market-btn', function () {
        let id = $(this).attr('data-id');     
        $('.edit-id').val(id);
        let full_path = main_url + '/admin/category-market/detail';
        $.get(full_path, {id: id}, function (data) {
            // if (data.code && data.code === 200) {
                $('.edit-name').val(data.cate.name);
                $('.edit-category').val(data.cate.parent_id);
                var $item = data.path;
                    $('.edit-file').append(`<div class="col-md-1 dbclick-delete-img"><input type="text" class=" custom-file-input image-add-again" id="example-file-multiple-input-custom" data-toggle="custom-file-input" name="imagelink[]" value="${$item}" style="display: none"><img src="/${$item}" style="width: 100px; height: 100px; padding-left: 10px; padding-right: 10px; margin-bottom: 10px;" class="edit-image"></div>`);
        });
        cleanFormEditCategoryMarket();
    });

    $('body').on('click', '.edit-cate-market-submit', function () {
        let full_path = main_url + '/admin/category-market/update';
        var formData = new FormData();
        formData.append('id', $('.edit-id').val());
        formData.append('name', $('.edit-name').val());
        // var $image = $('.edit-image').prop('files');
        // var $length = $image.length;
        // for (var $i = 0; $i < $length; $i++){
        //     formData.append('image[]', $image[$i]);
        // }
        // formData.append('depth', $('.create-depth').val());
        formData.append('parent_id', $('.edit-category').val());
        console.log($('.edit-name').val(), $('.edit-category').val());
        if ($('.edit-name').val() !== '') {
            $.ajax({
                type: "POST",
                url: full_path,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    console.log(data);

                // $("#result").text(data);
                $('#editCategoryMarket').modal('toggle');
                toastr.success('Sửa danh mục thành công');
                $('#cate-market-append').html(data.data);
                addOrdinalNumber('.table-cate-market');

            },
            error: function (e) {

                // $("#result").text(e.responseText);
                toastr.error('Lỗi! Không thể sửa danh mục');

            }
        });
    } else {
        if ($('.edit-name').val() === '') {
            toastr.error('Vui lòng nhập vào tên danh mục');
        }
    }
});
    ///////END-AGAIN-CREATE////////

    ///////*************************************************////////

    ///////DELETE////////
    $('body').on('click', '.delete-cate-market-btn', function () {
        $('.delete-cate-market-id').val($(this).attr('data-id'));
    });

    $('body').on('click', '.delete-cate-market-submit', function () {
        let id = $('.delete-cate-market-id').val();
        let full_path = main_url + '/admin/category-market/delete';
        $.post(full_path, {id: id}, function (data) {
            if(data.code && data.code === 200) {
                let trow = $(store['element']).closest('tr');
                let full_path =  main_url + '/admin/category-market/list?page=' + (curPage);
                console.log(full_path);
                $(trow).remove();
                $.get(full_path, function (data) {
                    if (data.code && data.code === 200) {
                        toastr.success('Xoá danh mục thành công');
                        $('#cate-market-append').html(data.data);
                        addOrdinalNumber('.table-cate-market');
                    } else {
                        toastr.error('Lỗi! Không thể xoá được danh mục');
                    }
                });
            } else {
                toastr.error('Lỗi! Không thể xoá được danh mục');
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
       url:"/admin/category-market/list?page="+page,
       success:function(data)
       {
        $('#cate-market-append').empty();
        $('#cate-market-append').html(data.data);
        addOrdinalNumber('.table-cate-market');
    }
});
  }

    ///////END-PAGINATE////////

    ///////*************************************************////////

    ///////SEARCH////////
    $('#search').on('keyup',function(){
        let full_path = main_url + '/admin/category-market/search';
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

    $('body').on('keyup', '#parent_id', function () {
        search();
    });

    $('body').on('keyup', '#depth', function () {
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
        let full_path = main_url + '/admin/category-market/logsearch';
        var parent_id = $('#parent_id').val();
        var depth = $('#depth').val();
        var time_start = $('#time-start').val();
        $.ajax({
            type : 'get',
            url : full_path,
            data:{parent_id: parent_id, depth: depth, time_start: time_start},
            success:function(data){
                console.log(data);
                $('tbody').html(data);
            }
        });
    }

    $('body').on('click', '#clear-filter', function () {
        $('#parent_id').val(0);
        $('#depth').val(0);
        $('#time-start').val('');
        search();
    });
    ///////END-SEARCH////////

//     ///////*************************************************////////

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
            toastr.success('Hãy kích chọn danh mục muốn xóa');  
        }  else {  


            var check = confirm("Bạn chắc chắn muốn xóa những danh mục này?");  
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

function cleanFormCreateCategoryMarket() {
    $('.create-name').val('');
    $('.create-image').val('');
    $('.create-category').val(null).trigger('change');
}

function cleanFormEditCategoryMarket() {
    $('.edit-name').val('');
    $('.edit-file').text('');
    $('.edit-image').val('');
    $('.edit-category').val(null).trigger('change');
}
