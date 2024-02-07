<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(auth()->user()->getRoleNames());
        $user = User::find(auth()->id());
        $countPeminjam = User::where('role', 'peminjam')->count();
        $countBuku = Buku::all()->count();
        return view('admin.master', ['user' => $user, 'countPeminjam' => $countPeminjam, 'countBuku' => $countBuku]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function view($id)
    {
        $user = User::findOrFail($id);
        $data = User::where('role', 'petugas')->get();

        return view('admin.masteradmin', ['data' => $data, 'user' => $user]);
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
            'role' => 'required',
        ]);

        $user =  User::create([
            'name' => $validatedData['name'],
            'namalengkap' => $validatedData['namalengkap'],
            'alamat' => $validatedData['alamat'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);
        $user->assignRole('petugas');
        
        $request->session()->flash('success', 'Akun Berhasil Dibuat!!');
        
        return redirect('/admincreate');
        
    }

    public function edit(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'namalengkap' => 'required|string|max:250',
            'alamat' => 'required|string|max:250',
            'email' => 'required|email:dns|max:250|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8', // Gunakan 'nullable' agar password opsional
            'role' => 'required',
        ]);

        // Periksa apakah password ada di dalam $validatedData, jika ya, hash password
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        // Proses selanjutnya

        $request->session()->flash('success', 'Akun Berhasil Diperbarui!!');

        return redirect('/admincreate');
    }
    

    public function addbuku()
    {
        $buku = Buku::all();
        return view('admin.masterbuku', ['buku' => $buku]);
    }

    public function addbukuprosses(Request $request){
        $validatedData = $request->validate([
            'judul' => 'required|string|max:250',
            'penulis' => 'required|string|max:250',
            'penerbit' => 'required|string|max:250',
            'tahunterbit' => 'required|integer',
        ]);

        Buku::create([
            'judul' => $validatedData['judul'],
            'penulis' => $validatedData['penulis'],
            'penerbit' => $validatedData['penerbit'],
            'tahunterbit' => $validatedData['tahunterbit'],
        ]);
        
        $request->session()->flash('success', 'Data Berhasil Di Tambahkan');
        
        return redirect('/addbuku');
    }
    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
