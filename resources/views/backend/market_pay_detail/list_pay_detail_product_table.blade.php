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
                    <th>Người thanh toán</th>
                    <th>Thời gian thanh toán</th>
                    <th class="text-center">Hành động</th>
                    {{-- <th class="text-center">Đăng lại</th> --}}
                </tr>
            </thead>
            <tbody class="table-pay-detail-market">
                @foreach($bills as $key => $bill)
                <tr id="tr_{{$bill->id}}">
                    <td class="text-center" style="display: none;"></td>
                    <td class="text-center">{{$curpage=$curpage+1}}</td>
                    <td class="text-center">{{$bill->id}}</td>
                    {{-- <td class="font-w600 post_title">{{$bill->name}}</td> --}}
                    <td class="font-w600">{{$bill->quantity_buy}}&emsp;chiếc</td>
                    <td class="font-w600">{{number_format($bill->total_money)}}&emsp;VNĐ</td>
                    @if(isset($bill->money_taken))
                    <td class="font-w600">{{number_format($bill->money_taken)}}&emsp;VNĐ</td>
                    @else
                    <td class="font-w600">Bill online</td>
                    @endif
                    @if(isset($bill->money_taken))
                    <td class="font-w600">{{number_format($bill->excess_cash)}}&emsp;VNĐ</td>
                    @else
                    <td class="font-w600">Bill online</td>
                    @endif
                    @if(isset($bill->userinfo->fullname))
                    <td class="font-w600">{{$bill->userinfo->fullname}}</td>
                    @else
                    <td class="font-w600"></td>
                    @endif
                    @if(isset($bill->user->name))
                    <td class="font-w600">{{$bill->user->name}}</td>
                    @else
                    <td class="font-w600"></td>
                    @endif
                    <td class="font-w600">{{date('d-m-Y H:i:s', strtotime($bill->created_at))}}</td>
                    <td class="text-center">
                        <div class="btn-group">
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
