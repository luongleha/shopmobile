<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\CurlConnectionRepository;
use App\Service\CategoryMarket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use DB;

class CategoryController extends Controller
{
//    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $ctmk_service;
    protected $curl_connect;

    public function __construct(CurlConnectionRepository $curl_connect, CategoryMarket $ctmk_service)
    {
        parent::__construct($curl_connect);
        $this->ctmk_service = $ctmk_service;
    }

    public function index(Request $request)
    {
        try {
            $result = $this->ctmk_service->catemarketList();
            $curpage = ($result->currentPage() * $result->perPage()) - $result->perPage();
            $count = $this->ctmk_service->catemarketcountList();

            if ($request->ajax()) {
                $view = view('backend.categories.list_category_table', [
                    'categories' => $result,
                    'curpage' => $curpage])->render();
                return response()->json(['code' => 200, 'data' => $view]);
            } else {
                return view('backend.categories.list_category', [
                    'categories' => $result,
                    'curpage' => $curpage,
                    'count' => $count]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function create(Request $request) {
        try {
            $user = Auth::user()->is_admin;
            $result = $this->ctmk_service->createCategory($request->all(), $user);
            return redirect()->route('category.index')->with('message success', 'Tạo mới thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function update(Request $request) {
        try {
            $option = 1;
            $user = Auth::user()->id;
            $request->validate([
                'id' => 'required',
            ]);
            $result = $this->ctmk_service->updateCategory($request->all(), $user);
            return redirect()->route('category.index')->with('message success', 'Tạo mới thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function detail(Request $request) {
        try {
            $option = 1;

            $category = Category::find($request->id);
            $path = $category->image;
            return response()->json(['cate' => $category, 'path' => $path]);
        } catch (\Exception $e) {
            $res = [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
            return response()->json($res);
        }
    }

    public function delete(Request $request) {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $user = Auth::user()->is_admin;
            $this->ctmk_service->deleteCategory($request->id, $user);
            return response()->json(['code' => 200, 'message' => 'Delete success']);
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function deleteMultiple(Request $request) {
        try {
            $ids = $request->ids;
            if ($user = Auth::user()->is_admin === 1) {
                Category::whereIn('id',explode(",",$ids))->delete();
            }
            return response()->json(['success'=>"Category Deleted successfully."]);
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        try {
        $user = Auth::user()->id;
        $result = $this->ctmk_service->catemarketList();
        $categories = Category::where(function($query) use($request){
                            $query->where('id','LIKE','%'.$request->value."%");
                            $query->orWhere('name','LIKE','%'.$request->value."%");
                        })
                        ->orderBy('id', 'desc')
                        ->get();
        if($request->ajax())
        {
                $view = view('backend.categories.search_category_table', ['categories' => $categories])->render();
                return response()->json($view);
        }
        else {
                return view('backend.categories.list_category',['categories' => $categories]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function logsearch(Request $request)
    {
        try {
        $user = Auth::user()->id;
        $result = $this->ctmk_service->catemarketList();
        $categories = Category::where(function($query) use($request){
                            if ($request->parent_id) {
                                $query->where('parent_id','LIKE','%'.$request->parent_id."%");
                            }
                            if ($request->depth) {
                                $query->where('depth','LIKE','%'.$request->depth."%");
                            }
                            if ($request->time_start) {
                                $query->where('created_at','LIKE','%'.$request->time_start."%");
                            }
                        })
                        ->orderBy('id', 'desc')
                        ->get();
        if($request->ajax())
        {
                $view = view('backend.categories.search_category_table', ['categories' => $categories])->render();
                return response()->json($view);
        }
        else {
                return view('backend.categories.list_post_product',['categories' => $categories]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }
}