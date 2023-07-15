<?php

namespace App\Http\Controllers;

use App\Models\ProductCategoryAdmin;
use Yajra\DataTables\Facades\Datatables;
use App\Models\OrdersAdmin;
use App\Models\ProductAdmin;
// use App\Models\OrdersItemAdmin;
use App\Models\ProductClient;
use App\Models\ProductImages;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        if (Session::get('role') !== "manager") return redirect()->route('admin.produk.list');

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
                    $actionBtn = '<a href="' . route('admin.produk.edit', $row->id) . '" class="btn btn-warning btn-sm btn-sm-action"><i class="bx bx-edit-alt"></i></a> <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-sm-action" data-id="' . $row->id . '" id="btnDelete"><i class="bx bx-trash"></i></a><form id="deleteForm" action="' . route('admin.produk.kategori.delete') . '" method="POST" class="d-none">' . csrf_field() . '</form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.produk.produk');
    }

    public function product_add()
    {
        $data['categories'] = ProductAdmin::all();
        return view('admin.produk.produk_form', $data);
    }

    public function product_create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',
            'img_details' => 'array|max:5',
            'img_details.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            'name' => 'required|unique:products',
            'cat_id' => 'required',
            'acq_price' => 'required',
            'sell_price' => 'required',
            'discount' => 'required|gte:0',
            'description' => 'required',
            'size' => 'required',
            'weight' => 'required',
            'manufacturer' => 'required',
        ], [
            'thumbnail.required' => 'Thumbnail harus diisi.',
            'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
            'thumbnail.mimes' => 'Thumbnail harus memiliki tipe file: jpeg, png, jpg, gif.',
            'img_details.max' => 'Detail Gambar tidak boleh lebih dari 5.',
            'img_details.*.required' => 'Detail Gambar harus diisi.',
            'img_details.*.image' => 'Detail Gambar harus berupa file gambar.',
            'img_details.*.mimes' => 'Detail Gambar harus memiliki tipe file: jpeg, png, jpg, gif.',
            'name.required' => 'Nama Produk harus diisi.',
            'name.unique' => 'Nama Produk sudah digunakan.',
            'cat_id.required' => 'Kategori harus diisi.',
            'acq_price.required' => 'Harga Belo harus diisi.',
            'sell_price.required' => 'Harga Jual harus diisi.',
            'discount.required' => 'Diskon harus diisi.',
            'discount.gte' => 'Diskon harus lebih besar dari atau sama dengan 0.',
            'description.required' => 'Deskripsi harus diisi.',
            'size.required' => 'Ukuran harus diisi.',
            'weight.required' => 'Berat harus diisi.',
            'manufacturer.required' => 'Produsen harus diisi.',
        ]);

        if ($validate->passes()) {
            $kategori = ProductCategoryAdmin::where('id', $request->cat_id)->first();

            $prefix = strtoupper(substr($kategori->name, 0, 3));
            $amount = ProductAdmin::where('cat_id', $request->cat_id)->count();
            $amount++;
            $sku = $prefix . '-' . str_pad($amount, 3, '0', STR_PAD_LEFT);

            $thumb = $request->file('thumbnail');
            $thumbName = Str::random(25) . '.' . $thumb->getClientOriginalExtension();
            $thumbPath = 'products/' . $thumbName;

            $data = $request->all();
            $data['thumbnail'] = $thumbPath;
            $data['sku'] = $sku;
            $data['slug'] = Str::slug($request->name);
            $data['acq_price'] = intval(str_replace(".", "", $request->acq_price));
            $data['sell_price'] = intval(str_replace(".", "", $request->sell_price));
            $data['discount'] = ($request->discount == 0 ? NULL : $request->discount);
            if ($data['discount']) {
                $data['discount_price'] = ($data['sell_price'] * $data['discount']) / 100;
            }
            $data['created_at'] = Carbon::now();

            $product = ProductAdmin::create($data);

            if ($product) {
                Storage::put('public/products/' . $thumbName, file_get_contents($thumb));

                $imgDetailPaths = [];
                foreach ($request->file('img_details') as $imgDetail) {
                    $imgDetailName = Str::random(25) . '.' . $imgDetail->getClientOriginalExtension();
                    $imgDetailPath = 'products/' . $imgDetailName;

                    Storage::put('public/products/' . $imgDetailName, file_get_contents($imgDetail));

                    $imgDetailPaths[] = $imgDetailPath;

                    $prodImages = new ProductImages();
                    $prodImages->prod_id = $product->id;
                    $prodImages->path = $imgDetailPath;
                    $prodImages->save();
                }
            }
            Session::flash('success', 'Produk berhasil ditambahkan!');
            return response()->json(['success' => true]);
        } else {
            return response()->json(['err' => $validate->errors()]);
        }
    }

    public function product_edit(ProductAdmin $params)
    {
        $data['product'] = ProductAdmin::where('id', $params->id)->first();
        $data['product_images'] = ProductImages::where('prod_id', $data['product']->id)->get();

        $data['categories'] = ProductAdmin::all();

        return view('admin.produk.produk_form', $data);
    }

    public function product_update(Request $request)
    {
        $product = ProductAdmin::where('id', $request->id)->first();

        ($request->name == $product->name ? $rule_name = 'required' : $rule_name = 'required|unique:products');

        var_dump($request->thumbnail . $request->file('thumbnail'));
        die;

        $validate = Validator::make($request->all(), [
            'thumbnail' => 'required|images|mimes:jpeg,png,jpg,gif',
            'img_details' => 'array|max:5',
            'img_details.*' => 'required|images|mimes:jpeg,png,jpg,gif',
            'name' => $rule_name,
            'cat_id' => 'required',
            'acq_price' => 'required',
            'sell_price' => 'required',
            'discount' => 'required|gte:0',
            'description' => 'required',
            'size' => 'required',
            'weight' => 'required',
            'manufacturer' => 'required',
        ], [
            'thumbnail.required' => 'Thumbnail harus diisi.',
            'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
            'thumbnail.mimes' => 'Thumbnail harus memiliki tipe file: jpeg, png, jpg, gif.',
            'img_details.max' => 'Detail Gambar tidak boleh lebih dari 5.',
            'img_details.*.required' => 'Detail Gambar harus diisi.',
            'img_details.*.image' => 'Detail Gambar harus berupa file gambar.',
            'img_details.*.mimes' => 'Detail Gambar harus memiliki tipe file: jpeg, png, jpg, gif.',
            'name.required' => 'Nama Produk harus diisi.',
            'name.unique' => 'Nama Produk sudah digunakan.',
            'cat_id.required' => 'Kategori harus diisi.',
            'acq_price.required' => 'Harga Belo harus diisi.',
            'sell_price.required' => 'Harga Jual harus diisi.',
            'discount.required' => 'Diskon harus diisi.',
            'discount.gte' => 'Diskon harus lebih besar dari atau sama dengan 0.',
            'description.required' => 'Deskripsi harus diisi.',
            'size.required' => 'Ukuran harus diisi.',
            'weight.required' => 'Berat harus diisi.',
            'manufacturer.required' => 'Produsen harus diisi.',
        ]);

        if ($validate->passes()) {
            $thumb = $request->file('thumbnail');
            $thumbName = Str::random(25) . '.' . $thumb->getClientOriginalExtension();
            $thumbPath = 'products/' . $thumbName;


            dd($thumb);
        } else {
            return response()->json(['err' => $validate->errors()]);
        }
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
            // $data = OrdersItemAdmin::join('orders', 'order_items.order_id', '=', 'orders.id')
            //     ->join('products', 'order_items.prod_id', '=', 'products.id')
            //     ->join('product_categories', 'products.cat_id', '=', 'product_categories.id')
            //     ->join('users', 'orders.user_id', '=', 'users.id')
            //     ->select('order_items.*', 'products.name', 'products.sell_price', 'products.discount_price', 'products.discount', 'products.thumbnail', 'product_categories.name AS category_name', 'orders.*', 'users.name AS customer_name', 'users.email AS customer_email', 'users.phone_number AS customer_phone', 'users.address AS customer_address')
            //     ->get();

            $dataOrders = OrdersAdmin::join('users', 'orders.user_id', '=', 'users.id')
                ->select('orders.*', 'users.name AS customer_name', 'users.email AS customer_email', 'users.phone_number AS customer_phone', 'users.address AS customer_address')
                ->get();

            return Datatables::of($dataOrders)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm" id="btnEdit"><i class="bx bx-edit-alt"></i> Ubah Status</a><form id="editForm" action="' . route('admin.pesanan.ubah_status') . '" method="POST" class="d-none">' . csrf_field() . '</form>';
                    return $actionBtn;
                })
                ->addColumn('detail', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-info btn-sm" id="btnDetail"><i class="bx bx-show"></i> Lihat</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'detail']) // <-- Add the 'detail' column here
                ->make(true);
        }

        return view('admin.pesanan.list');
    }

    public function orders_edit(OrdersAdmin $params)
    {
        $data = OrdersAdmin::where('id', $params->id)->first();
        echo json_encode($data);
    }

    public function update_status_order(Request $request)
    {
        try {
            $orders = OrdersAdmin::where('id', $request->id)->first();
            $orders->status = $request->status;
            $orders->save();

            Session::flash('success', 'Status Pesanan Berhasil diubah!');
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Kategori tidak ada!']);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function users_customer(Request $request)
    {
        // menampilkan page kategori produk admin
        if (Session::get('role') !== "manager") return redirect()->route('admin.produk.list');

        if ($request->ajax()) {
            $roles = ['pelanggan'];
            $data = User::select('*')->whereIn('role', $roles)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $deactivateBtn = '<a href="javascript:void(0)" class="btn btn-danger btn-sm" id="btnDelete" data-id="' . $row->id . '" ><i class="bx bx-block"></i></a><form id="deleteForm" action="' . route('admin.deactivate.customer') . '" method="POST" class="d-none">' . csrf_field() . '</form>';
                    $activatenBtn ='<a href="javascript:void(0)" class="btn btn-success btn-sm" id="btnActivate" data-id="' . $row->id . '" ><i class="bx bx-lock-open"></i></a><form id="activateForm" action="' . route('admin.activate.customer') . '" method="POST" class="d-none">' . csrf_field() . '</form>';

                    return $row->status ? $deactivateBtn : $activatenBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.list-customer');
    }

    public function deactivate_account(Request $request)
    {
        try {
            $data = User::find($request->id);
            $data->status = 0;

            $data->save();

            Session::flash('success', 'User berhasil dinonaktifkan!');
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['err' => $e]);
        }
    }

    public function activate_account(Request $request)
    {
        try {
            $data = User::find($request->id);
            $data->status = 1;

            $data->save();

            Session::flash('success', 'User berhasil diaktifkan kembali!');
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['err' => $e]);
        }
    }

    public function users_admin(Request $request)
    {
        if (Session::get('role') !== "manager") return redirect()->route('admin.produk.list');

        $roles = ['admin', 'manager'];
        $data = User::select('*')->whereIn('role', $roles)->get();

        // menampilkan page kategori produk admin
        if ($request->ajax()) {

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" id="btnEdit" data-id="' . $row->id . '"><i class="bx bx-edit-alt"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.list-admin');
    }

    public function create_user_admin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required|in:admin,manager,pelanggan',
        ], [
            'name.required' => 'Nama User harus diisi.',
            'email.required' => 'Email User harus diisi dan belum pernah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'role.required' => 'Role Harus diisi.',
        ]);

        if ($validate->passes()) {
            // Buat pengguna baru
            $user = new User();

            $user_exist = User::where('email', $request->email)->first();

            if ($user_exist) {
                return response()->json(['success' => false, 'msg' => 'User dengan email tersebut sudah terdaftar!']);
            }
            if ($request->image_url) {
                $image_path = Str::random(25) . '.' . $request->file('image_url')->getClientOriginalExtension();

                Storage::put('public/users/' . $image_path, file_get_contents($request->file('image_url')));
                $user->image_url = '/users/thumbnail-' . $image_path;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->role = $request->role;
            // Simpan pengguna baru ke dalam database
            $user->save();

            Session::flash('success', 'Produk berhasil ditambahkan!');
            return view('admin.user.list-admin');
        } else {
            return response()->json(['err' => $validate->errors()]);
        }
    }

    public function update_user_admin(Request $request)
    {
        try {
            $user = User::find($request->params);
            if ($request->image_url && $request->file) {
                $image_path = Str::random(25) . '.' . $request->file('image_url')->getClientOriginalExtension();

                Storage::put('public/users/' . $image_path, file_get_contents($request->file('image_url')));
                $user->image_url = '/users/thumbnail-' . $image_path;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->role = $request->role;
            // Simpan pengguna baru ke dalam database
            $user->save();

            Session::flash('success', 'Produk berhasil diubah!');
            return view('admin.user.list-admin');
        } catch (Exception $e) {
            return response()->json(['err' => $e]);
        }
    }

    public function get_data_user(Request $request)
    {
        try {
            $user = User::find($request->params);
            return response()->json(['success' => true, "data" => $user]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Kategori tidak ada!']);
        }
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
