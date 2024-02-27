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
        $buku = Buku::paginate(5);
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
            // Tambahkan data jumlahPinjaman dari input form dengan nama 'stok'
            $data['jumlahPinjaman'] = $request->input('stok');
            try {
                // Kurangi stok buku
                $buku = Buku::findOrFail($buku_id);
                
                if ($buku->stok >= $data['jumlahPinjaman'] && $data['jumlahPinjaman'] > 0) {
                    $buku->stok -= $data['jumlahPinjaman'];
                    $buku->save();
                    
                    // Simpan data peminjaman ke dalam tabel peminjaman
                    Peminjaman::create($data);
                } else {
                    return redirect()->back()->with('error', 'Stok buku tidak mencukupi atau jumlah peminjaman tidak valid.');
                }
            } catch (\Exception $e) {
                // Tanggapi jika terjadi kesalahan
                return redirect()->back()->with('error', 'Gagal menyimpan peminjaman. Silakan coba lagi.');
            }
            
            // Redirect atau kembalikan ke halaman yang sesuai
            return redirect()->route('pinjaman', ['id' => Peminjaman::latest()->first()->id])->with('success', 'Peminjaman berhasil disimpan.');
        }

    public function kembalikanBuku($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            // Handle jika peminjaman tidak ditemukan
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan');
        }

        // Pastikan status_peminjam adalah 'success' dan tanggal_pengembalian masih kosong
        if ($peminjaman->status_peminjam === 'success' && !$peminjaman->tanggal_pengembalian) {
            // Lakukan pembaruan tanggal pengembalian di sini
            $peminjaman->tanggal_pengembalian = now();
            $peminjaman->status_peminjam = 'success';
            $peminjaman->save();

            // Tambahkan stok buku
            $buku = Buku::findOrFail($peminjaman->buku_id);
            $buku->stok += 1;
            $buku->save();

            return response()->json(['message' => 'Buku berhasil dikembalikan']);
        } else {
            return response()->json(['error' => 'Tidak dapat mengembalikan buku. Periksa status peminjaman.']);
        }
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
