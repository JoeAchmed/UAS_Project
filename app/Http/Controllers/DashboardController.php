<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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

    /**
     * Display a listing of the resource.
     */
    public function productList()
    {
        // menampilkan page list produk admin
        return view('admin.produk.list');
    }

    /**
     * Display a listing of the resource.
     */
    public function categoryProduct()
    {
        // menampilkan page kategori produk admin
        return view('admin.produk.kategori');
    }

    /**
     * Display a listing of the resource.
     */
    public function orders()
    {
        // menampilkan page pesanan admin
        return view('admin.pesanan.list');
    }

    /**
     * Display a listing of the resource.
     */
    public function users()
    {
        // menampilkan page pesanan admin
        return view('admin.user.list');
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
