<?php

namespace App\Http\Controllers;


use PDF; 
use Excel;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use App\Exports\BukuExport;
use Illuminate\Http\Request;
use App\Exports\PetugasExport;
use App\Exports\ReviewExsport;
use App\Exports\PeminjamanExport;

class DowloadController extends Controller
{

    //Peminjaman
    public function downloadPeminjamanPDF(Request $request)
    {
        $data = Peminjaman::all(); // Gantilah dengan logika pengambilan data yang sesuai

        $pdf = PDF::loadView('pinjaman.pdf', compact('data')); // Gantilah dengan nama view dan variabel yang sesuai

        return $pdf->download('peminjaman_data.pdf');
    }

    public function downloadPeminjamanExcel(Request $request)
    {
        $filename = ' peminjaman ' . date('d-m') . '.xlsx';

        return Excel::download(new PeminjamanExport, $filename);
    }

    //Buku
    public function downloadBukuPDF(Request $request)
    {
        $data = Buku::all(); // Gantilah dengan logika pengambilan data yang sesuai

        $pdf = PDF::loadView('buku.pdf', compact('data')); // Gantilah dengan nama view dan variabel yang sesuai

        return $pdf->download('buku_data.pdf');
    }

    public function downloadBukuExcel(Request $request)
    {
        $filename = ' buku ' . date('d-m') . '.xlsx';

        return Excel::download(new BukuExport, $filename);
    }

    //Petugas
    public function downloadPetugasPDF(Request $request)
    {
        $data = User::where('role', 'petugas')->get(); // Gantilah dengan logika pengambilan data yang sesuai

        $pdf = PDF::loadView('petugas.pdf', compact('data')); // Gantilah dengan nama view dan variabel yang sesuai

        return $pdf->download('petugas_data.pdf');
    }

    public function downloadPetugasExcel(Request $request)
    {
        $filename = ' petugas ' . date('d-m') . '.xlsx';

        return Excel::download(new PetugasExport, $filename);
    }
}
