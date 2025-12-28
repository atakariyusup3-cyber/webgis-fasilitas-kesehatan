<!DOCTYPE html>
<html>
<head><title>Detail Klinik</title></head>
<body>
<h2>{{ $klinik->nama }}</h2>
<p>{{ $klinik->alamat }}</p>
<p>{{ $klinik->latitude }}, {{ $klinik->longitude }}</p>
<a href="/">⬅ Kembali</a>
</body>
</html>
