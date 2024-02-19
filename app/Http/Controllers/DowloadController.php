<?php

namespace App\Http\Controllers;


use PDF; 
use Excel;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Exports\ReviewExsport;
use App\Exports\PeminjamanExport;

class DowloadController extends Controller
{
    public function downloadPeminjamanPDF(Request $request)
    {
        $data = Peminjaman::all(); // Gantilah dengan logika pengambilan data yang sesuai

        $pdf = PDF::loadView('pinjaman.pdf', compact('data')); // Gantilah dengan nama view dan variabel yang sesuai

        return $pdf->download('peminjaman_data.pdf');
    }

    public function downloadPeminjamanExcel(Request $request)
    {
        // $data = Peminjaman::all(); // Gantilah dengan logika pengambilan data yang sesuai

        // $fileName = 'peminjaman_data.xlsx';

        // return Excel::download(new PeminjamanExport($data), $fileName);

        $filename = ' peminjaman ' . date('d-m') . '.xlsx';

        return Excel::download(new PeminjamanExport, $filename);
    }
}
