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
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vị trí</th>
                    <th>Thời gian</th>
                    <th class="text-center">Hành động</th>
                    {{-- <th class="text-center">Đăng lại</th> --}}
                </tr>
            </thead>
            <tbody class="table-user">
                @foreach($users as $key => $user)
                <tr id="tr_{{$user->id}}">
                    <td class="text-center" style="display: none;"></td>
                    <td class="tdcheckbox tdcheckboxs">
                        <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" class="css-control-input sub_chk" id="val-terms" name="val-terms" value="1" data-id="{{$user->id}}">
                                <span class="css-control-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">{{$curpage=$curpage+1}}</td>
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
        </tbody>
    </table>
    <div class="paginate-links">{{ $users->links() }}</div>
</div>
</div>
