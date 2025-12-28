<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Apotik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Leaflet -->
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

    <h3 class="mb-3">💊 Data Apotik</h3>

    <a href="/apotik/create" class="btn btn-success mb-3">
        ➕ Tambah Apotik
    </a>

    <!-- ALERT -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

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
                    @forelse ($apotik as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td class="text-center">{{ $item->latitude }}</td>
                        <td class="text-center">{{ $item->longitude }}</td>
                        <td class="text-center">

                            <!-- DETAIL -->
                            <a href="/apotik/{{ $item->id }}" 
                               class="btn btn-info btn-sm mb-1">
                                Detail
                            </a>

                            <!-- HAPUS -->
                            <form action="/apotik/{{ $item->id }}" 
                                  method="POST"
                                  style="display:inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data apotik ini?')">
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
                            Data apotik belum tersedia
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
            🗺️ Peta Lokasi Apotik
        </div>
        <div class="card-body">
            <div id="map"></div>
        </div>
    </div>

    <a href="/" class="btn btn-secondary">
        ⬅ Kembali ke Peta Utama
    </a>

</div>

<!-- ================= SCRIPT MAP ================= -->
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const lat = urlParams.get('lat');
    const lng = urlParams.get('lng');

    const initialView = (lat && lng) 
        ? [parseFloat(lat), parseFloat(lng)] 
        : [-8.6574, 121.0794];

    const initialZoom = (lat && lng) ? 15 : 9;

    const map = L.map('map').setView(initialView, initialZoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    const redIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    fetch('/apotik/json')
        .then(res => res.json())
        .then(data => {
            data.forEach(item => {
                const marker = L.marker(
                    [item.latitude, item.longitude],
                    { icon: redIcon }
                ).addTo(map)
                 .bindPopup(`<strong>${item.nama}</strong><br>${item.alamat}`);

                if (lat && lng &&
                    parseFloat(lat) === item.latitude &&
                    parseFloat(lng) === item.longitude) {
                    marker.openPopup();
                }
            });
        });
</script>

</body>
</html>
