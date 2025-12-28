<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data {{ $judul }}</title>
    <link rel="icon" href="/images/logo.png">
    <style>
        body { font-family: Arial; background:#f5f5f5; margin:0 }
        .header { background:#41bbbd; color:#fff; padding:20px }
        .container { padding:20px }
        table { width:100%; border-collapse:collapse; background:#fff }
        th, td { padding:12px; border-bottom:1px solid #ddd }
        th { background:#e8f5e9 }
        a.btn {
            background:#36a1bc; color:white;
            padding:6px 10px; text-decoration:none;
            border-radius:4px; font-size:14px;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Data {{ $judul }}</h2>
</div>

<div class="container">
    <a href="/" class="btn">⬅ Kembali ke Peta</a>
    <br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        @foreach($data as $i => $d)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->alamat }}</td>
            <td>
                <a href="/{{ $route }}/{{ $d->id }}" class="btn">Detail</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

</body>
</html>
