{{-- <!DOCTYPE html>
<head>
    <title>Laporan Buku</title>
    <style>
        table tr td{
            font-size: 13;
        }
        table tr .text{
            text-align: right;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <center>
        <table border="2">
            <tr>
                <td><img src="{{ asset('logo/smkn4.png') }}" width="90" height="90"></td>
                <td>
                    <center>
                        <font size="4">LAPORAN BUKU</font>
                        <font size="5">SMKN 4 PAYAKUMBUH</font>
                        <font size="2">Lembaga Perpustakaan Smkn 4 Payakumbuh</font>
                        <font size="2">Jl. Koto Kociak, Kel.Padang Sikabu, Kec. Lamposi Tigo Nagori, Padang Sikabu, Kec. Lamposi Tigo Nagori, Kota Payakumbuh, Sumatera Barat 26219
                        </font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
        </table>
        <table border="1" width="1423">
            <tr >
                <td class="text">Payakumbuh, 16-02-2023</td>
            </tr>
        </table>
        <br>
        <table border="1" width="1423">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($buku as $peminjaman)
                    <tr style="text-align: center;">
                        <td>{{ $no++ }}</td>
                        <td>{{ $peminjaman->judul }}</td>
                        <td>{{ $peminjaman->penulis }}</td>
                        <td>{{ $peminjaman->penerbit }}</td>
                        <td>{{ $peminjaman->tahunterbit }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </center>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Buku</title>
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
                        <font size="4">LAPORAN BUKU</font><br>
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
                <td colspan="4"><hr><hr></td>
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
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($buku as $peminjaman)
                    <tr style="text-align: center;">
                        <td>{{ $no++ }}</td>
                        <td>{{ $peminjaman->judul }}</td>
                        <td>{{ $peminjaman->penulis }}</td>
                        <td>{{ $peminjaman->penerbit }}</td>
                        <td>{{ $peminjaman->tahunterbit }}</td>
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