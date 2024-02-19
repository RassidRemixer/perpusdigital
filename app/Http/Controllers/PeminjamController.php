<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
        return view('admin.masterbuku', ['buku' => $buku]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show()
    {
        $peminjamans = Peminjaman::with('user', 'buku')->get();
        return view('pinjaman.detail', compact('peminjamans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil 'user_id' dari pengguna yang sudah terotentikasi
        $user_id = auth()->id();
        $buku_id = $request->input('buku_id');
        
        $request->merge(['user_id' => $user_id, 'buku_id' => $buku_id]);

        // Pastikan hanya atribut yang diizinkan yang diambil dari request
        $data = $request->only(['user_id', 'buku_id', 'tanggal_peminjaman', 'tanggal_pengembalian', 'status_peminjam']);

        // Setel tanggal peminjaman dengan created_at
        $data['tanggal_peminjaman'] = $request->input('tanggal_peminjaman');

        try {
            // Simpan data peminjaman ke dalam tabel peminjaman
            Peminjaman::create($data);
        } catch (\Exception $e) {
            // Tanggapi jika terjadi kesalahan
            return redirect()->back()->with('error', 'Gagal menyimpan peminjaman. Silakan coba lagi.');
        }
        
        // Redirect atau kembalikan ke halaman yang sesuai
        // return redirect()->route('pinjaman.show', ['id' => $data['id']])->with('success', 'Peminjaman berhasil disimpan.');
        return redirect()->route('pinjaman', ['id' => Peminjaman::latest()->first()->id])->with('success', 'Peminjaman berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function kembalikanBuku($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            // Handle jika peminjaman tidak ditemukan
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan');
        }

        // Lakukan pembaruan tanggal pengembalian di sini
        $peminjaman = Peminjaman::find($id);
        $peminjaman->tanggal_pengembalian = now();
        $peminjaman->status_peminjam = 'success';
        $peminjaman->save();

        return response()->json(['message' => 'Buku berhasil dikembalikan']);
    }


    public function updateStatus($id, Request $request)
    {
        // Validate the request
        $request->validate([
            'status_peminjam' => 'required|in:pending,success',
        ]);

        // Find the Peminjaman by ID
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Peminjaman not found.');
        }

        // Update the status
        $peminjaman->update([
            'status_peminjam' => $request->input('status_peminjam'),
        ]);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }


}
