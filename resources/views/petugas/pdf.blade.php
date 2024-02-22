<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>

    <!-- Bootstrap CSS (jika Anda menggunakan Bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Atur gaya sesuai kebutuhan Anda -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>

    <h1>Data Petugas</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $peminjaman)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $peminjaman->name }}</td>
                    <td>{{ $peminjaman->email }}</td>
                    <td>{{ $peminjaman->namalengkap }}</td>
                    <td>{{ $peminjaman->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>PerpustakaanDigital By RassidRisdaSulpa</p>
    </div>

</body>
</html>