<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\CurlConnectionRepository;
use App\Service\UserSevice;
use App\Service\FacebookAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Models\UserInfor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use DB;

class UserController extends Controller
{
//    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $us_service;
    protected $curl_connect;

    public function __construct(CurlConnectionRepository $curl_connect, UserSevice $us_service)
    {
        parent::__construct($curl_connect);
        $this->us_service = $us_service;
    }

    public function index(Request $request)
    {
        try {
            $result = $this->us_service->userList();            
            $curpage = ($result->currentPage() * $result->perPage()) - $result->perPage();
            $count = $this->us_service->userCountList();

            if ($request->ajax()) {
                $view = view('backend.users.list_user_table', [
                    'users' => $result,
                    'curpage' => $curpage])->render();
                return response()->json(['code' => 200, 'data' => $view]);
            } else {
                return view('backend.users.list_user', [
                    'users' => $result,
                    'curpage' => $curpage,
                    'count' => $count]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function detail(Request $request) {
        try {
            $option = 1;
            $users = User::find($request->id);
            $path = $users->image;

            return response()->json(['users' => $users, 'path' => $path]);
        } catch (\Exception $e) {
            $res = [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
            return response()->json($res);
        }
    }


    public function create(Request $request) {
        try {
            $user = Auth::user()->is_admin;
            $result = $this->us_service->createUser($request->all(), $user);
            return redirect()->route('users.index')->with('message success', 'Tạo mới thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function update(Request $request) {
        try {
            $option = 1;
            $user = Auth::user()->is_admin;
            $request->validate([
                'id' => 'required',
            ]);
            $result = $this->us_service->editUser($request->all(), $user);
            return redirect()->route('users.index')->with('message success', 'Tạo mới thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function delete(Request $request) {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $user = Auth::user()->is_admin;
            $this->us_service->deleteUser($request->id, $user);
            return response()->json(['code' => 200, 'message' => 'Delete success']);
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function deleteMultiple(Request $request) {
        try {
            $ids = $request->ids;
            if (Auth::user()->is_admin === 1) {
                User::whereIn('id',explode(",",$ids))->delete();
            }
            return response()->json(['success'=>"User Deleted successfully."]);
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        try {
        $user = Auth::user()->id;
        $result = $this->us_service->userList();
        $users = User::where(function($query) use($request){
                            $query->where('id','LIKE','%'.$request->value."%");
                            $query->orWhere('name','LIKE','%'.$request->value."%");
                            $query->orwhere('email','LIKE','%'.$request->value."%");
                        })
                        ->orderBy('id', 'desc')
                        ->get();
        if($request->ajax())
        {
                $view = view('backend.users.search_user_table', ['users' => $users])->render();
                return response()->json($view);
        }
        else {
                return view('backend.users.list_user',['users' => $users]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function logsearch(Request $request)
    {
        try {
        $user = Auth::user()->id;
        $result = $this->us_service->userList();
        $users = User::where(function($query) use($request){
                            if ($request->is_admin) {
                                $query->where('is_admin','LIKE','%'.$request->is_admin."%");
                            }
                            if ($request->time_start) {
                                $query->where('created_at','LIKE','%'.$request->time_start."%");
                            }
                        })
                        ->orderBy('id', 'desc')
                        ->get();
        if($request->ajax())
        {
                $view = view('backend.users.search_user_table', ['users' => $users])->render();
                return response()->json($view);
        }
        else {
                return view('backend.users.list_user',['users' => $users]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }
}