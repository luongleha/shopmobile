<?php

namespace App\Repositories;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DB;

class ProductMarketRepository
{
    public function getList()
    {
        try {
            return Product::orderBy('id', 'desc')->paginate(8);
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
            return Product::get()->count();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createPostOrder($data, $user)
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

                    $url = 'storage/product/' . $namefilecut;
                    Storage::disk('public')->putFileAs('product', $image, $namefilecut);
                    $info_image[] = [
                        'url' => $url,
                        'name' => $namefilecut
                    ];
                }
            }

            if (isset($data['imagelink'])) {
                $images = $data['imagelink'];
                foreach ($images as $key => $image) {

                    // $namefile = $image->getClientOriginalName().$date.'.jpg';
                    $namefile = pathinfo($image);                    
                    $namefilecut = $namefile['basename'];
                    $url = $image;
                    $info_image[] = [
                        'url' => $url,
                        'name' => $namefilecut
                    ];
                }
            }

            $product = new Product();
            $product->name = $data['name'];
            $product->quantity = $data['quantity'];
            $product->origin_price = $data['origin_price'];
            $product->sale_price = $data['sale_price'];
            $product->category_id = $data['category'];
            $product->content = $data['content'];
            $product->status = $data['status'];
            $product->user_id = $user;
            $product->hot = $data['hot'];

            $product->save();

            $product_id = $product->id;

            foreach ($info_image as $img) {
                $path = $img['url'];
                $name = $img['name'];
                Image::create([
                    'product_id' => $product_id,
                    'path' => $path,
                    'name' => $name,
                ]);
            }
            return Product::all();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function editPostOrder($data, $user)
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

                    $url = 'storage/product/' . $namefilecut;
                    Storage::disk('public')->putFileAs('product', $image, $namefilecut);
                    $info_image[] = [
                        'url' => $url,
                        'name' => $namefilecut
                    ];
                }
            }

            if (isset($data['imagelink'])) {
                $images = $data['imagelink'];
                foreach ($images as $key => $image) {

                    // $namefile = $image->getClientOriginalName().$date.'.jpg';
                    $namefile = pathinfo($image);                    
                    $namefilecut = $namefile['basename'];
                    $url = $image;
                    $info_image[] = [
                        'url' => $url,
                        'name' => $namefilecut
                    ];
                }
            }

            $product = Product::find($data['id']);
            $product->name = $data['name'];
            $product->quantity = $data['quantity'];
            $product->origin_price = $data['origin_price'];
            $product->sale_price = $data['sale_price'];
            $product->category_id = $data['category'];
            $product->content = $data['content'];
            $product->status = $data['status'];
            $product->user_id = $user;
            $product->hot = $data['hot'];

            $product->save();

            $product_id = $product->id;

            foreach ($info_image as $img) {
                $path = $img['url'];
                $name = $img['name'];
                Image::create([
                    'product_id' => $product_id,
                    'path' => $path,
                    'name' => $name,
                ]);
            }
            return Product::all();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getPostCategory()
    {
        try {
            return Category::get();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deletePost($id) {
        try {
            Product::destroy($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
