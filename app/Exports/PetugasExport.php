<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PetugasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil data dari model Petugas dengan role 'petugas'
        $petugasData = User::where('role', 'petugas')
            ->select('name', 'email', 'namalengkap', 'alamat')
            ->get();

        // Tambahkan nomor urut sementara
        $petugasData->transform(function ($item, $key) {
            $item['no'] = $key + 1;
            return $item;
        });

        // Buat array untuk kolom yang akan diekspor
        $exportData = $petugasData->map(function ($item) {
            return [
                'no' => $item['no'],
                'name' => $item['name'],
                'email' => $item['email'],
                'namalengkap' => $item['namalengkap'],
                'alamat' => $item['alamat'],
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
            'Nama',
            'Email',
            'Nama Lengkap',
            'Alamat',
        ];
    }
}
