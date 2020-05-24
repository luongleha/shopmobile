<?php

namespace App\Repositories;
use App\Models\Category;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DB;

class CategoryMarketRepository
{
    public function getList()
    {
        try {
            return Category::orderBy('id', 'desc')->paginate(8);
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
            return Category::get()->count();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createCategory($data, $user)
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

                    $url = 'storage/category/' . $namefilecut;
                    Storage::disk('public')->putFileAs('category', $image, $namefilecut);
                    $info_image[] = [
                        'url' => $url,
                        'name' => $namefilecut
                    ];
                }
            }

            if ($user === 1) {
                $category = new Category();
                $category->name = $data['name'];
                if(isset($url)){
                $category->image = $url;
                }
                // $category->slugs = \Illuminate\Support\Str::slug($data['name']);
                // $category->depth = $data['depth'];
                if (isset($data['parent_id'])) {
                    $category->parent_id = $data['parent_id'];
                }else{
                    $category->parent_id = 0;
                }
            }
            else{
                dd('không có quyền tạo');
            }
            $category->save();
            return Category::all();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateCategory($data, $user)
    {
        try {
            if ($user === 1) {
                $category = Category::find($data['id']);
                $category->name = $data['name'];
                if(isset($url)){
                $category->image = $url;
                }
                // $category->slugs = \Illuminate\Support\Str::slug($data['name']);
                // $category->depth = $data['depth'];
                if (isset($data['parent_id'])) {
                    $category->parent_id = $data['parent_id'];
                    }
            }
            else{
                dd('không có quyền tạo');
            }
            $category->save();
            return Category::all();

        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteCategory($id, $user) {
        try {
            if ($user === 1) {
            Category::destroy($id);
            }
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
