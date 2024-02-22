<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class BukuExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil data dari model Buku
        $bukuData = Buku::select('judul', 'penulis', 'penerbit', 'tahunterbit')->get();

        // Tambahkan nomor urut sementara
        $bukuData->transform(function ($item, $key) {
            $item['no'] = $key + 1;
            return $item;
        });

        // Buat array untuk kolom yang akan diekspor
        $exportData = $bukuData->map(function ($item) {
            return [
                'no' => $item['no'],
                'judul' => $item['judul'],
                'penulis' => $item['penulis'],
                'penerbit' => $item['penerbit'],
                'tahunterbit' => $item['tahunterbit'],
            ];
        });

        // Kembalikan data yang akan diekspor sebagai Collection
        return new Collection($exportData);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Judul kolom untuk file Excel
        return [
            'No',
            'Judul',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
        ];
    }
}
