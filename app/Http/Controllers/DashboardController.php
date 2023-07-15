<?php

namespace App\Http\Controllers;

use App\Models\ProductCategoryAdmin;
use Yajra\DataTables\Facades\Datatables;
use App\Models\OrdersAdmin;
use App\Models\ProductAdmin;
use App\Models\OrdersItemAdmin;
use App\Models\ProductClient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
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

    // ----------- AUTH
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
                            'name' => $user->name,
                            'email' => $user->email,
                            'image_url' => $user->image_url,
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

    // ----------- PRODUCTS
    public function products(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductAdmin::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-warning btn-sm btn-sm-action" id="btnEdit"><i class="bx bx-edit-alt"></i></a> <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-sm-action" data-id="' . $row->id . '" id="btnDelete"><i class="bx bx-trash"></i></a><form id="deleteForm" action="' . route('admin.produk.kategori.delete') . '" method="POST" class="d-none">' . csrf_field() . '</form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.produk.produk');
    }

    // ----------- CATEGORY PRODUCTS
    public function categories(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductCategoryAdmin::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-warning btn-sm btn-sm-action" id="btnEdit"><i class="bx bx-edit-alt"></i></a> <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-sm-action" data-id="' . $row->id . '" id="btnDelete"><i class="bx bx-trash"></i></a><form id="deleteForm" action="' . route('admin.produk.kategori.delete') . '" method="POST" class="d-none">' . csrf_field() . '</form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.produk.kategori');
    }
    public function category_add(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|unique:product_categories',
        ], [
            'name.required' => "Nama Kategori tidak boleh kosong!",
            'name.unique' => "Kategori sudah terdaftar!"
        ]);

        if ($validate->passes()) {
            $data = $request->all();
            $data['slug'] = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            if (ProductCategoryAdmin::create($data)) {
                Session::flash('success', 'Kategori berhasil ditambahkan!');
                return response()->json(['success' => true]);
            }
        } else {
            return response()->json(['err' => $validate->errors()]);
        }
    }
    public function category_edit(ProductCategoryAdmin $params)
    {
        $data = ProductCategoryAdmin::where('id', $params->id)->first();
        echo json_encode($data);
    }
    public function category_update(Request $request)
    {
        $category = ProductCategoryAdmin::where('id', $request->id)->first();
        ($request->name == $category->name ? $rule_name = 'required' : $rule_name = 'required|unique:product_categories');

        $validate = Validator::make($request->all(), [
            'name' => $rule_name,
        ], [
            'name.required' => "Nama kategori tidak boleh kosong!",
            'name.unique' => "Kategori sudah terdaftar!",
        ]);

        if ($validate->passes()) {
            $data = $request->all();
            $data['slug'] = Str::slug($request->name);
            $data['updated_at'] = Carbon::now();

            if ($category->update($data)) {
                Session::flash('success', 'Kategori berhasil diubah!');
                return response()->json(['success' => true]);
            }
        } else {
            return response()->json(['err' => $validate->errors()]);
        }
    }
    public function category_delete(Request $request)
    {
        $category = ProductCategoryAdmin::where('id', $request->id)->first();
        if ($category->delete()) {
            Session::flash('success', 'Kategori berhasil dihapus!');
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'msg' => 'Kategori tidak ada!']);
        }
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
