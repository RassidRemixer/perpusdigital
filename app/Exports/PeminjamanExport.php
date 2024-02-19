<?php

namespace App\Exports;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PeminjamanExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithColumnFormatting
{
        public function collection()
    {
        $peminjamans = Peminjaman::with(['user', 'buku'])->get();

        return $peminjamans->map(function ($item, $key) {
            $peminjam = $item->user; // Mengambil user dari relasi user
            $book = $item->buku; // Mengambil buku dari relasi buku

            return [
                'No' => $key + 1,
                'Peminjam' => $peminjam ? $peminjam->name : 'Nama tidak ditemukan',
                'Judul Buku' => $book ? $book->judul : 'Judul tidak ditemukan',
                'Penerbit' => $book ? $book->penerbit : 'Penerbit tidak ditemukan',
                'Tanggal Peminjaman' => $item->tanggal_peminjaman,
                'Tanggal Pengembalian' => $item->tanggal_pengembalian,
                'Status Peminjam' => $item->status_peminjam,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Nama Pengguna', 'Judul Buku', 'Penerbit', 'Tanggal Peminjaman', 'Tanggal Pengembalian', 'Status Peminjam'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:G1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ];

                $event->sheet->getStyle('A1:G100')->applyFromArray($styleArray);
            },
        ];
    }
    public function columnFormats(): array
    {
        return [
            'E' => 'yyyy-mm-dd', // Format kolom tanggal pinjam
            'F' => 'yyyy-mm-dd', // Format kolom tanggal pengembalian
        ];
    }

}