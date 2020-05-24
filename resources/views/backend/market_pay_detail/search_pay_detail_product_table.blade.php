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
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-secondary show-market-btn" data-target="#billDetailMarket" data-toggle="modal" title="xem chi tiết" data-id="{{$bill->id}}">
                                <i class="fa fa-eye"></i>
                            </button>
                    </div>
                </td>
            </tr>
            @endforeach