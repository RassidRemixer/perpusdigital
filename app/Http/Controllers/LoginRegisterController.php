<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\LoginRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('guest')->except([
    //         'logout', 'dashboard'
    //     ]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('logis.login');
    }

    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        return view('logis.registrasi');
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'namalengkap' => 'required|string|max:250',
            'alamat' => 'required|string|max:250',
            'email' => 'required|email:dns|max:250|unique:users',
            'password' => 'required|min:8|',
            
            
        ]);

        $user =  User::create([
            'name' => $validatedData['name'],
            'namalengkap' => $validatedData['namalengkap'],
            'alamat' => $validatedData['alamat'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'peminjam',
            
        ]);
        $user->assignRole('user');
        $request->session()->flash('success', 'Akun Berhasil Dibuat!!');

        return redirect('/login');
        
    }

    /**
     * Display the specified resource.
     */
    public function authenticate( Request $request)
    {
        $login = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($login)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('failed', 'Gagal Login');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('succes','Logout Berhasil');
    }  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoginRegister $loginRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoginRegister $loginRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoginRegister $loginRegister)
    {
        //
    }
}
