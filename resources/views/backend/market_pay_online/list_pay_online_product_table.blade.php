<div class="block-content block-content-full table-responsive">
    <div class="table-responsive">
        <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        {{-- <table class="table table-striped table-vcenter js-dataTable-full-pagination"> --}}
          <table class="table table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">ID</th>
                    {{-- <th>Tên sản phẩm</th> --}}
                    <th>Số lượng</th>
                    <th>Giá bán</th>
                    <th>Tiền nhận</th>
                    <th>Tiền thừa</th>
                    <th>Người mua hàng</th>
                    <th>Thời gian thanh toán</th>
                    <th class="text-center">Hành động</th>
                    {{-- <th class="text-center">Đăng lại</th> --}}
                </tr>
            </thead>
            <tbody class="table-pay-online-market">
                @foreach($bills as $key => $bill)
                <tr id="tr_{{$bill->id}}">
                    <td class="text-center" style="display: none;"></td>
                    <td class="text-center">{{$curpage=$curpage+1}}</td>
                    <td class="text-center">{{$bill->id}}</td>
                    {{-- <td class="font-w600 post_title">{{$bill->name}}</td> --}}
                    <td class="font-w600">{{$bill->quantity_buy}}&emsp;chiếc</td>
                    <td class="font-w600">{{number_format($bill->total_money)}}&emsp;VNĐ</td>
                    <td class="font-w600">{{number_format($bill->money_taken)}}&emsp;VNĐ</td>
                    <td class="font-w600">{{number_format($bill->excess_cash)}}&emsp;VNĐ</td>
                    @if(isset($bill->userinfo->fullname))
                    <td class="font-w600">{{$bill->userinfo->fullname}}</td>
                    @else
                    <td class="font-w600"></td>
                    @endif
                    <td class="font-w600">{{date('d-m-Y H:i:s', strtotime($bill->created_at))}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-secondary confirm-btn" data-target="#confirmOnlineMarket"
                            data-toggle="modal" title="Xác nhận" data-id="{{$bill->id}}">xác nhận</i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary show-market-btn" data-target="#billDetailMarket" data-toggle="modal" title="xem chi tiết" data-id="{{$bill->id}}">
                                xem
                            </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate-links">{{ $bills->links() }}</div>
</div>
</div>
