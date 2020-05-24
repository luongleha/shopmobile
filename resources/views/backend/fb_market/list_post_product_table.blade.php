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
                    <th class="text-center">Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>User</th>
                    <th>Trạng thái</th>
                    <th>Top</th>
                    <th>Thời gian</th>
                    <th class="text-center">Hành động</th>
                    {{-- <th class="text-center">Đăng lại</th> --}}
                </tr>
            </thead>
            <tbody class="table-fb-market">
                @foreach($products as $key => $product)
                <tr id="tr_{{$product->id}}">
                    <td class="text-center" style="display: none;"></td>
                    <td class="tdcheckbox tdcheckboxs">
                        <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" class="css-control-input sub_chk" id="val-terms" name="val-terms" value="1" data-id="{{$product->id}}">
                                <span class="css-control-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">{{$curpage=$curpage+1}}</td>
                    <td class="text-center">{{$product->id}}</td>
                    <td class="img-post-history">
                        @foreach($product->images as $key => $image)
                        @if($key == 0)
                        <img src="/{{$image['path']}}" alt="">
                        @endif
                        @endforeach
                    </td>
                    <td class="font-w600">{{$product->name}}</td>
                    <td class="font-w600">{{$product->quantity}}&ensp;chiếc</td>
                    <td class="font-w600">{{$product->category->name}}</td>
                    <td class="font-w600">{{$product->user->name}}</td>
                    <td class="font-w600">
                        @if($product->status === 0)
                        <span class="badge badge-warning">Đang nhập</span>
                        @endif
                        @if($product->status === 1)
                        <span class="badge badge-success">Mở bán</span>
                        @endif
                        @if($product->status === -1)
                        <span class="badge badge-info">Hết hàng</span>
                        @endif
                    </td>
                    <td class="font-w600">
                        @if($product->hot === 0)
                        <label class="css-control css-control-lg css-control-danger css-checkbox">
                            <input type="checkbox" class="css-control-input edit-sell-fast" disabled>
                            <span class="css-control-indicator"></span>
                        </label>
                        @endif
                        @if($product->hot === 1)
                        <label class="css-control css-control-lg css-control-danger css-checkbox">
                            <input type="checkbox" class="css-control-input edit-sell-fast" checked disabled>
                            <span class="css-control-indicator"></span>
                        </label>
                        @endif
                    </td>
                    <td class="font-w600">{{date('d-m-Y H:i:s', strtotime($product->created_at))}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-secondary create-again-fb-market-btn" data-target="#againcreateFacebookMarket" data-toggle="modal" title="đăng lại" data-id="{{$product->id}}">
                                chỉnh sửa
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary delete-fb-market-btn" data-target="#deleteFacebookMarket"
                            data-toggle="modal" title="Xóa" data-id="{{$product->id}}">xóa
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate-links">{{ $products->links() }}</div>
</div>
</div>
