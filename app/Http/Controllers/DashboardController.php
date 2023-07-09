<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan page dashboard admin
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        // show login-dbo
        return view('auth.login-dbo');
    }

    /**
     * POST login admin
     */
    public function postLogin(Request $request)
    {
        // show login-dbo
        // return view('auth.login-dbo');
        $email = $request->email;
        $password = $request->password;

        // $user = User::where('email', $email)->get();
        $user = User::where('email', '=', $email)->first();
        // Hash::check('INPUT PASSWORD', $user->password);

        // $hashedPassword = Hash::make($password);

        if ($user->role == 'admin') {
            
        }

        if (Hash::check($password, $user->password)) {
            // Password matches
            // Add your desired logic here
            dd('ok ');

        } else {
            // Password does not match
            // Add your desired logic here
            dd('gagal ');
        }
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
