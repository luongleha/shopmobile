<div class="block-content block-content-full table-responsive">
    <div class="table-responsive">
        <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        {{-- <table class="table table-striped table-vcenter js-dataTable-full-pagination"> --}}
          <table class="table table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">ID</th>
                    <th>Tổng bill</th>
                    <th>Tổng số lượng bán ra</th>
                    <th>Tổng tiền thu về</th>
                    <th>Tổng khách</th>
                    <th>Người chốt</th>
                    <th>Chốt lúc</th>
                </tr>
            </thead>
            <tbody class="table-fb-market">
                @foreach($dailysales as $key => $dailysale)
                <tr id="tr_{{$dailysale->id}}">
                    <td class="text-center" style="display: none;"></td>
                    <td class="text-center">{{$key+1}}</td>
                    <td class="text-center">{{$dailysale->id}}</td>
                    <td class="font-w600">{{$dailysale->total_bill}}</td>
                    <td class="font-w600">{{$dailysale->total_quantity}}&emsp;chiếc</td>
                    <td class="font-w600">{{number_format($dailysale->total_money)}}&emsp;VNĐ</td>
                    <td class="font-w600">{{$dailysale->total_userinfo}}</td>
                    <td class="font-w600">{{$dailysale->user->name}}</td>
                    <td class="font-w600">{{date('d-m-Y H:i:s', strtotime($dailysale->created_at))}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div class="paginate-links">{{ $dailysales->links() }}</div> --}}
</div>
</div>
