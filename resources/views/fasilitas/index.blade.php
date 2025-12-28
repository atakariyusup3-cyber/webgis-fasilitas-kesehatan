<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Puskesmas</title>
    <link rel="icon" href="/images/logo.png">
    <style>
        body { font-family: Arial, sans-serif; background:#f5f5f5; padding:20px }
        table { width:100%; border-collapse: collapse; background:#fff }
        th, td { padding:10px; border:1px solid #ddd }
        th { background:#2e8675; color:white }
        a { text-decoration:none; color:#1e8799; font-weight:bold }
    </style>
</head>
<body>

<h2>📋 Data Puskesmas</h2>
<a href="/">⬅ Kembali ke Peta</a>
<br><br>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    @foreach($data as $i => $p)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $p->nama }}</td>
        <td>{{ $p->alamat }}</td>
        <td>
            <a href="/puskesmas/{{ $p->id }}">Detail</a>
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>
