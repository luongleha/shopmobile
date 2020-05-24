<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Validator;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::get();
        $userinfo = UserInfo::paginate(15);
        // $users = User::simplePaginate(15);

        return view('backend.userinfo.index')->with([
            'userinfo' => $userinfo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('view-dashboard')) {
            return view('backend.userinfo.create');
        }else{
            return abort(404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info_image = [];
        if ($request->hasFile('image')){
            $images = $request->file('image');
            foreach ($images as $key => $image){

//                cach 1
//                $id = $key;
//                $namefile = $id . '.png';

//                cach2
                $namefile = $image->getClientOriginalName();
                $url = 'storage/userinfo/' . $namefile;
                Storage::disk('public')->putFileAs('userinfo', $image, $namefile);
                $info_image[] = [
                    'url' => $url,
                    'name' => $namefile
                ];
            }
        }
        else{
            dd('khong co file');
        }

        $userinfo = new UserInfo();
        $userinfo->fullname = $request->get('fullname');
        $userinfo->email = $request->get('email');
        $userinfo->phone = $request->get('phone');
        $userinfo->address = $request->get('address');
        $userinfo->image = $url;
        // dd($user);
        // dd(1);
        $save = $userinfo->save();
        if ($save) {
            $request->session()->flash('success', 'Tạo userinfo thành công' . '<br>');
        } else {
            $request->session()->flash('fail', 'Tạo userinfo thất bại' . '<br>');
        }

        return redirect()->route('backend.userinfo.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        return view('backend.userinfo.show')->with('userinfo', $userinfo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userinfo = UserInfor::find($id);
        return view('backend.userinfo.edit')->with('userinfo', $userinfo);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $info_image = [];
        if ($request->hasFile('image')){
            $images = $request->file('image');
            foreach ($images as $key => $image){

//                cach 1
//                $id = $key;
//                $namefile = $id . '.png';

//                cach2
                $namefile = $image->getClientOriginalName();
                $url = 'storage/userinfo/' . $namefile;
                Storage::disk('public')->putFileAs('userinfo', $image, $namefile);
                $info_image[] = [
                    'url' => $url,
                    'name' => $namefile
                ];
            }
        }

        $fullname = $request->get('fullname');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $image = $request->get('image');

        $userinfo = UserInfor::find($id);
        $userinfo->fullname = $fullname;
        $userinfo->email = $email;
        $userinfo->phone = $phone;
        $userinfo->address = $address;
        $userinfo->image = $image;
        // dd($user);
        // dd(1);

        $save = $userinfo->save();

        if ($save) {
            $request->session()->flash('success_update', 'Cập nhật userinfo thành công' . '<br>');
        } else {
            $request->session()->flash('fail_update', 'Cập nhật userinfo thất bại' . '<br>');
        }
        return redirect()->route('backend.userinfo.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserInfo::destroy($id);
        return redirect()->route('backend.userinfo.index');
    }
}
