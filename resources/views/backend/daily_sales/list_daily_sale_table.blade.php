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
                    <th>Người mua hàng</th>
                    <th>Người thanh toán</th>
                    <th>Thời gian thanh toán</th>
                    {{-- <th class="text-center">Đăng lại</th> --}}
                </tr>
            </thead>
            <tbody class="table-daily-sales-market">
                @foreach($bills as $key => $bill)
                <tr id="tr_{{$bill->id}}">
                    <td class="text-center" style="display: none;"></td>
                    <td class="text-center">{{$key+1}}</td>
                    <td class="text-center">{{$bill->id}}</td>
                    {{-- <td class="font-w600 post_title">{{$bill->name}}</td> --}}
                    <td class="font-w600">{{$bill->quantity_buy}}&emsp;chiếc</td>
                    <td class="font-w600">{{number_format($bill->total_money)}}&emsp;VNĐ</td>
                    <td class="font-w600">{{$bill->userinfo->fullname}}</td>
                    <td class="font-w600">{{$bill->user->name}}</td>
                    <td class="font-w600">{{date('d-m-Y H:i:s', strtotime($bill->created_at))}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div class="paginate-links">{{ $bills->links() }}</div> --}}
    <table class="table table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center">Tổng số bill</th>
                    <th>Tổng số lượng bán ra</th>
                    <th>Tổng tiền thu về</th>
                </tr>
            </thead>
            <tbody class="table-fb-market">
                
                <tr id="tr_">
                    <form>
                    <td class="text-center">{{$sum_bill}}</td>
                    <td class="font-w600">{{$sum_quantity}}&emsp;chiếc</td>
                    <td class="font-w600">{{number_format($sum_money)}}&emsp;VNĐ</td>
                    <td class="font-w600" style="display: none;"><input type="text" class="create-total-quantity" id="val-number" name="val-number" style="display: none;" value="{{$sum_quantity}}" disabled></td>
                    <td class="font-w600" style="display: none;"><input type="text" class="create-total-money" id="val-number" name="val-number" style="display: none;" value="{{$sum_money}}" disabled></td>
                    </form>
            </tr>
        </tbody>
    </table>
    <div style="text-align: center;"><button type="button" class="btn btn-primary create-daily-sale-submit">Chốt</button></div>
</div>
</div>
