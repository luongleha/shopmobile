@foreach($users as $key => $user)
                <tr id="tr_{{$user->id}}">
                    <td class="text-center" style="display: none;"></td>
                    <td class="tdcheckbox tdcheckboxs">
                        <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" class="css-control-input sub_chk" id="val-terms" name="val-terms" value="1" data-id="{{$user->id}}">
                                <span class="css-control-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">{{$key+1}}</td>
                    <td class="text-center">{{$user->id}}</td>
                    <td class="font-w600 post_title">{{$user->name}}</td>
                    <td class="font-w600">{{$user->email}}</td>
                    <td class="font-w600">
                        @if($user->is_admin == 1) Admin @endif
                        @if($user->is_admin == 2) User @endif
                    </td>
                    <td class="font-w600">{{date('d-m-Y H:i:s', strtotime($user->created_at))}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-secondary edit-user-btn" data-target="#editUser" data-toggle="modal" data-id="{{$user->id}}">chỉnh sửa
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary delete-user-btn" data-target="#deleteUser"
                            data-toggle="modal" title="Xóa" data-id="{{$user->id}}">Xóa
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach