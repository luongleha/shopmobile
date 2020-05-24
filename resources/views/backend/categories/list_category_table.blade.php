<div class="block-content block-content-full table-responsive">
    <div class="table-responsive">
        <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        {{-- <table class="table table-striped table-vcenter js-dataTable-full-pagination"> --}}
          <table class="table table-striped table-vcenter">
            <thead>
                <tr>
                    <th width="50px" class="thcheckbox thcheckboxs">
                        <label class="css-control css-control-primary css-checkbox" style="padding: 3px 0">
                            <input type="checkbox" class="css-control-input" id="master" name="radio-group6">
                            <span class="css-control-indicator"></span>
                        </label>
                    </th>
                    <th class="text-center">STT</th>
                    <th class="text-center">ID</th>
                    <th>Tên danh mục</th>
                    <th>Mục cha</th>
                    {{-- <th>Dộ sâu</th> --}}
                    <th>Thời gian</th>
                    <th class="text-center">Hành động</th>
                    {{-- <th class="text-center">Đăng lại</th> --}}
                </tr>
            </thead>
            <tbody class="table-cate-market">
                @foreach($categories as $key => $category)
                <tr id="tr_{{$category->id}}">
                    <td class="text-center" style="display: none;"></td>
                    <td class="tdcheckbox tdcheckboxs">
                        <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" class="css-control-input sub_chk" id="val-terms" name="val-terms" value="1" data-id="{{$category->id}}">
                                <span class="css-control-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">{{$curpage=$curpage+1}}</td>
                    <td class="text-center">{{$category->id}}</td>
                    <td class="font-w600 post_title">{{$category->name}}</td>
                    <td class="font-w600">{{$category->parent_id}}</td>
                    {{-- <td class="font-w600">{{$category->depth}}</td> --}}
                    <td class="font-w600">{{date('d-m-Y H:i:s', strtotime($category->created_at))}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-secondary edit-cate-market-btn" data-target="#editCategoryMarket" data-toggle="modal" title="đăng lại" data-id="{{$category->id}}">
                                chỉnh sửa
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary delete-cate-market-btn" data-target="#deleteCategoryMarket"
                            data-toggle="modal" title="Xóa" data-id="{{$category->id}}">xóa
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate-links">{{ $categories->links() }}</div>
</div>
</div>
