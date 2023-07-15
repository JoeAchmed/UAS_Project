<?php

namespace App\Http\Controllers;

use App\Models\ProductCategoryAdmin;
use Yajra\DataTables\Facades\Datatables;
use App\Models\OrdersAdmin;
use App\Models\OrdersItemAdmin;
use App\Models\ProductClient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = ProductClient::getCategoryProduct();
        $orders = OrdersAdmin::getOrders();
        $total_sales = OrdersAdmin::getTotalSales();

        return view('admin.dashboard', compact(['orders', 'categories', 'total_sales']));
    }

    public function login()
    {
        if (Session::get('user_id') != null) {
            return redirect(route('admin.dashboard'));
        }
        return view('auth.login-dbo');
    }

    public function postLogin(Request $request)
    {
        if (Session::get('user_id') != null) {
            return redirect(route('admin.dashboard'));
        }

        $email = $request->email;
        $password = $request->password;

        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => "Input email tidak boleh kosong!",
            'email.email' => "Format email tidak sesuai!",
            'password.required' => "Input password tidak boleh kosong!"
        ]);


        if ($validation->passes()) {
            $user = User::where('email', '=', $email)->first();

            if ($user) {
                if ($user->role == 'admin' || $user->role == 'manager') {
                    if (Hash::check($password, $user->password)) {
                        session()->put([
                            'user_id' => $user->id,
                            'role' => $user->role
                        ]);
                        return response()->json(['success' => true]);
                    } else {
                        return response()->json(['success' => false, 'msg' => 'Akun anda tidak terdaftar!']);
                    }
                } else {
                    return response()->json(['success' => false, 'msg' => 'Akun anda tidak terdaftar!']);
                }
            } else {
                return response()->json(['success' => false, 'msg' => 'Akun anda tidak terdaftar!']);
            }
        } else {
            return response()->json(['err' => $validation->errors()]);
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect(route('admin.login'));
    }


    public function productList()
    {
        // menampilkan page list produk admin
        return view('admin.produk.list');
    }

    /**
     * Display a listing of the resource.
     */
    public function categories(Request $request)
    {
        // menampilkan page kategori produk admin
        if ($request->ajax()) {
            $data = ProductCategoryAdmin::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.produk.kategori');
    }

    public function category_datas(Request $request)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function orders(Request $request)
    {
        // menampilkan page kategori produk admin
        if ($request->ajax()) {
            $data = OrdersItemAdmin::join('orders', 'order_items.order_id', '=', 'orders.id')
                ->join('products', 'order_items.prod_id', '=', 'products.id')
                ->join('product_categories', 'products.cat_id', '=', 'product_categories.id')
                ->select('order_items.*', 'products.name', 'products.sell_price', 'products.discount_price', 'products.discount', 'products.thumbnail', 'product_categories.name AS category_name', 'orders.*')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" id="btnEdit"><i class="bx bx-edit-alt"></i></a> <a href="javascript:void(0)" class="btn btn-danger btn-sm" id="btnDelete"><i class="bx bx-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pesanan.list');
    }

    /**
     * Display a listing of the resource.
     */
    public function usersCustomer(Request $request)
    {
        // menampilkan page kategori produk admin
        if ($request->ajax()) {
            $roles = ['pelanggan'];
            $data = User::select('*')->whereIn('role', $roles)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" id="btnEdit"><i class="bx bx-edit-alt"></i></a> <a href="javascript:void(0)" class="btn btn-danger btn-sm" id="btnDelete"><i class="bx bx-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.list-customer');
    }

    public function usersAdmin(Request $request)
    {
        // menampilkan page kategori produk admin
        if ($request->ajax()) {
            $roles = ['admin', 'manager'];
            $data = User::select('*')->whereIn('role', $roles)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" id="btnEdit"><i class="bx bx-edit-alt"></i></a> <a href="javascript:void(0)" class="btn btn-danger btn-sm" id="btnDelete"><i class="bx bx-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.list-admin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
