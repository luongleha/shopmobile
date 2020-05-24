<?php

namespace App\Repositories;
use App\Models\User;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use DB;

class UserRepository
{
    public function userList()
    {
        try {
            return User::orderBy('id', 'desc')->paginate(8);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getListID($id)
    {
        try {
            return Post::find($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function countList()
    {
        try {
            return User::get()->count();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createUser($data, $user)
    {
        try {
            $info_image = [];
            if (isset($data['image'])) {
                $date = time();
                $random = rand(1111, 9999);
                $images = $data['image'];
                foreach ($images as $key => $image) {

                    // $namefile = $image->getClientOriginalName().$date.'.jpg';
                    $namefile = pathinfo($image->getClientOriginalName());
                    $namefilecut = $namefile['filename']. '-' . $date . '-' . $random .'.'.$namefile['extension'];

                    $url = 'storage/user/' . $namefilecut;
                    Storage::disk('public')->putFileAs('user', $image, $namefilecut);
                    $info_image[] = [
                        'url' => $url,
                        'name' => $namefilecut
                    ];
                }
            }
            else{
            dd('khong co file');
            }

            if ($user === 1) {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['pass']);
            $user->is_admin = $data['is_admin'];
            $user->image = $url;

            $user->save();
            }
            else{
                dd('không có quyền tạo');
            }
            
            return User::all();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function editUser($data, $user)
    {
        try {
            $info_image = [];
            if (isset($data['image'])) {
                $date = time();
                $random = rand(1111, 9999);
                $images = $data['image'];
                foreach ($images as $key => $image) {

                    // $namefile = $image->getClientOriginalName().$date.'.jpg';
                    $namefile = pathinfo($image->getClientOriginalName());
                    $namefilecut = $namefile['filename']. '-' . $date . '-' . $random .'.'.$namefile['extension'];

                    $url = 'storage/user/' . $namefilecut;
                    Storage::disk('public')->putFileAs('user', $image, $namefilecut);
                    $info_image[] = [
                        'url' => $url,
                        'name' => $namefilecut
                    ];
                }
            }
            else{
            dd('khong co file');
            }

            if ($user === 1) {
            $user = User::find($data['id']);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->image = $url;
            $user->password = Hash::make($data['pass']);
            $user->is_admin = $data['is_admin'];
            $user->save();
            }
            else{
                dd('không có quyền sửa');
            }
            
            return User::all();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteUser($id, $user) {
        try {
            if ($user === 1) {
                User::destroy($id);
            }else{
                dd('Không có quyền xóa');
            }
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
