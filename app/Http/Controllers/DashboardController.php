<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Dashboard;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Pagination\LengthAwarePaginator;

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
        $countPeminjaman = Peminjaman::all()->count();
        return view('admin.master', ['user' => $user, 'countPeminjam' => $countPeminjam, 'countBuku' => $countBuku, 'countPeminjaman' => $countPeminjaman]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function view()
    {
        // $users = User::all();
        $data = User::where('role', 'petugas')->get();
        // dd($data);
        
        return view('admin.masteradmin', compact('data'));
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
        $validatedData['role'] = 'petugas';
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

    public function edit(Request $request, $id, User $user)
    {

        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'namalengkap' => 'required|string|max:250',
            'alamat' => 'required|string|max:250',
            'email' => 'required|email:dns|max:250|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8', // Gunakan 'nullable' agar password opsional
            'role' => 'required',
        ]);

        // dd($validatedData);

        // Periksa apakah password ada di dalam $validatedData, jika ya, hash password
        if (isset($validatedData['password']) && !empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        

        // dd($user);
        $user->update($request->all());

        // Proses selanjutnya

        $request->session()->flash('success', 'Akun Berhasil Diperbarui!!');

        return redirect('/admincreate');
    }

    public function addbuku(Request $request)
    {
        // $perPage = 10;
        // $buku = Buku::paginate();
        $buku = Buku::paginate(5);
        return view('admin.masterbuku', ['buku' => $buku]);
    }

    public function addbukuprosses(Request $request){
        $validatedData = $request->validate([
            'judul' => 'required|string|max:250',
            'penulis' => 'required|string|max:250',
            'penerbit' => 'required|string|max:250',
            'tahunterbit' => 'required|integer',
            'stok' => 'required|integer|min:0', // Validasi untuk stok
        ]);
    
        Buku::create([
            'judul' => $validatedData['judul'],
            'penulis' => $validatedData['penulis'],
            'penerbit' => $validatedData['penerbit'],
            'tahunterbit' => $validatedData['tahunterbit'],
            'stok' => $validatedData['stok'], // Menambahkan stok ke dalam data yang disimpan
        ]);
    
        $request->session()->flash('success', 'Data Berhasil Di Tambahkan');
        
        return redirect('/addbuku');
    }

    public function editbuku(Request $request, $id, User $buku)
    {
        $buku = Buku::findOrFail($id);
        $validatedData = $request->validate([
            'judul' => 'required|string|max:250',
            'penulis' => 'required|string|max:250',
            'penerbit' => 'required|string|max:250',
            'tahunterbit' => 'required|integer',
        ]);
        // dd($validatedData);
        
        // dd($user);
        $buku->update($request->all());
        // Proses selanjutnya
        $request->session()->flash('success', 'Buku Berhasil Diperbarui!!');
        return redirect('/addbuku');
    }

    // public function hapus(Request $request, $id)
    // {
    //     $buku = Buku::findOrFail($id);
    //     $buku->delete();


    //     return redirect('/addbuku')->with('succes', 'buku berhasil di hapus');
    // }

    public function hapus(Request $request, $id)
    {
        return DB::transaction(function () use ($id) {
            $buku = Buku::findOrFail($id);
    
            // Periksa apakah relasi peminjamans sudah dimuat
            if ($buku->peminjaman()->count() > 0) {
                // Hapus peminjaman yang terkait
                $buku->peminjaman()->delete();
            }
    
            // Hapus buku
            $buku->delete();
    
            return redirect('/addbuku')->with('success', 'Buku dan peminjamannya berhasil dihapus');
        });
    }


    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();


        return redirect('/admincreate')->with('succes', 'data berhasil di hapus');
    }

    public function laporan()
    {
        
        $buku = Buku::all();
        return view('laporan', ['buku' => $buku]);
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
