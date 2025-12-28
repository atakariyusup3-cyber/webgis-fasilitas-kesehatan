<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Posyandu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        #map {
            height: 400px;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-light p-4">

<div class="container">

    <h3 class="mb-3">👶 Data Posyandu</h3>

    <a href="/posyandu/create" class="btn btn-success mb-3">
        ➕ Tambah Posyandu
    </a>

    <!-- ================= TABLE ================= -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posyandu as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td class="text-center">{{ $item->latitude }}</td>
                        <td class="text-center">{{ $item->longitude }}</td>
                        <td class="text-center">

                            <!-- DETAIL -->
                            <a href="/posyandu/{{ $item->id }}"
                               class="btn btn-info btn-sm mb-1">
                                Detail
                            </a>

                            <!-- HAPUS -->
                            <form action="/posyandu/{{ $item->id }}"
                                  method="POST"
                                  style="display:inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data posyandu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Data Posyandu belum tersedia
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= MAP ================= -->
    <div class="card shadow-sm mb-3">
        <div class="card-header fw-bold">
            🗺️ Peta Lokasi Posyandu
        </div>
        <div class="card-body">
            <div id="map"></div>
        </div>
    </div>

    <a href="/" class="btn btn-secondary">
        ⬅ Kembali ke Peta Utama
    </a>

</div>

<script>
const map = L.map('map').setView([-8.6574, 121.0794], 9);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

fetch('/posyandu/json')
.then(res => res.json())
.then(data => {
    data.forEach(item => {
        L.marker([item.latitude, item.longitude])
        .addTo(map)
        .bindPopup(`<strong>${item.nama}</strong><br>${item.alamat}`);
    });
});
</script>

</body>
</html>
