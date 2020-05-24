@foreach($categories as $key => $category)
                <tr id="tr_{{$category->id}}">
                    <td class="text-center" style="display: none;"></td>
                    <td class="tdcheckbox tdcheckboxs">
                        <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" class="css-control-input sub_chk" id="val-terms" name="val-terms" value="1" data-id="{{$category->id}}">
                                <span class="css-control-indicator"></span>
                        </label>
                    </td>
                    <td class="text-center">{{$key+1}}</td>
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