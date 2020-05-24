@foreach($bills as $key => $bill)
                <tr id="tr_{{$bill->id}}">
                    <td class="text-center" style="display: none;"></td>
                    <td class="text-center">{{$key+1}}</td>
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