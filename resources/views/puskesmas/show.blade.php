<!DOCTYPE html>
<html>
<head>
    <title>Detail Puskesmas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>{{ $puskesmas->nama }}</h2>
<ul class="list-group mb-3">
    <li class="list-group-item"><b>Alamat:</b> {{ $puskesmas->alamat }}</li>
    <li class="list-group-item"><b>Latitude:</b> {{ $puskesmas->latitude }}</li>
    <li class="list-group-item"><b>Longitude:</b> {{ $puskesmas->longitude }}</li>
</ul>

<a href="/puskesmas" class="btn btn-secondary">⬅ Kembali</a>

</body>
</html>
