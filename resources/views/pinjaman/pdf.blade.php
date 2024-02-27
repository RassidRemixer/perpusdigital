<!DOCTYPE html>
<html lang="en">
<head>
    <title>LAPORAN PEMINJAMAN</title>
    <style>
        body {
            /* font-family: 'Calibri', Arial, sans-serif;  */
            line-height: 1.6;
            color: #333;
        }

        .report-container {
            width: 100%;
            max-width: 800px; /* Atur sesuai kebutuhan */
            margin: 0 auto; /* Agar konten berada di tengah */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table tr td {
            font-size: 12pt; /* Ukuran font ditingkatkan */
            padding: 10px; /* Padding tambahan */
        }

        table tr .text {
            text-align: right;
            font-size: 12pt; /* Ukuran font ditingkatkan */
            padding: 1;
            margin-top: -14px; /* Padding tambahan */
        }

        .logo {
            text-align: center;
            margin-top: 70px; /* Margin tambahan ke atas */
        }

        .logo img {
            width: 70px;
            height: 70px;
            margin-top: 70px; 
        }

        .title {
            font-size: 13pt; /* Ukuran font ditingkatkan */
            margin-bottom: 1; /* Margin tambahan */
        }

        .subtitle {
            font-size: 18pt; /* Ukuran font ditingkatkan */
            margin-bottom: 1px; /* Margin tambahan */
        }

        .description {
            font-size: 12pt; /* Ukuran font ditingkatkan */
            font-style: italic; /* Teks menjadi miring */
            margin-bottom: 10px; /* Margin tambahan */
        }

        .fancy-line {
            border: none;
            height: 1mm; /* Ketebalan garis */
            background-image: linear-gradient(to right, #ccc, #333, #ccc);
        }
        table {
            margin-top: -5px;
        }
    </style>
</head>
<body >
    <div class="report-container">
        <table >
            <tr>

                <td class="logo">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logo/smkn4.png'))) }}" alt="Logo SMKN 4">
                </td>                
                <td>
                    <center>
                        <font size="4">LAPORAN PEMINJAMAN</font><br>
                        <font size="5"><b>SMKN 4 PAYAKUMBUH</b></font><br>
                        <font size="2">Lembaga Perpustakaan Smkn 4 Payakumbuh</font><br>
                        <font size="2"><i>Jl. Koto Kociak, Kel.Padang Sikabu, Kec. Lamposi Tigo Nagori, Padang Sikabu, Kec. Lamposi Tigo Nagori, Kota Payakumbuh, Sumatera Barat 26219</i></font> 
                    </center>
                </td>
                <td class="logo">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logo/smkn4.png'))) }}" alt="Logo SMKN 4">
                </td>                
            </tr>
            <tr style="margin-top: -10px" width="100%">
                <td colspan="3"><hr><hr></td>
            </tr>
        </table>
        {{-- <table width="100%">
            <tr>
                <td class="text">Payakumbuh, 16-02-2023</td>
            </tr>
        </table> --}}
        
        {{-- <br> --}}

        <table border="2" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Judul Buku</th>
                    <th>Penerbit</th>
                    <th>Buku Di Pinjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($data as $peminjaman)
                    <tr style="text-align: center;">
                    <td>{{ $no++ }}</td>
                    <td>{{ $peminjaman->user->name }}</td>
                    <td>{{ $peminjaman->buku->judul }}</td>
                    <td>{{ $peminjaman->buku->penerbit }}</td>
                    <td>{{ $peminjaman->jumlahPinjaman }}</td>
                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                    <td>{{ $peminjaman->tanggal_pengembalian ?? '-----' }}</td>
                    <td style="color: {{ $peminjaman->status_peminjam === 'pending' ? 'red' : ($peminjaman->status_peminjam === 'success' ? 'green' : 'blue') }}">
                        {{ $peminjaman->status_peminjam }}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table width="100%">
            <tr>
                <td width="100%"></td>
                <td class="text2"  align="center" style="text-align: center">KEPALA PERPUSTAKAAN  <br><br><br><br>Ranti Erminasari</td>
            </tr>
        </table>
    </div>
</body>
</html>