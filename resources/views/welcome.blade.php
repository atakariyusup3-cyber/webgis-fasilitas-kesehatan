<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>WebGIS Fasilitas Kesehatan</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 10px;
        }

        #map {
            height: 500px;
            margin-bottom: 10px;
        }

        #formTambah {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            width: 340px;
            background: #f9f9f9;
        }

        input, select {
            width: 100%;
            margin-bottom: 6px;
            padding: 6px;
        }

        button {
            padding: 6px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

{{-- <h2>WebGIS Fasilitas Kesehatan</h2>

@if(session('success'))
    <p style="color: rgb(16, 143, 201)">{{ session('success') }}</p>
@endif

<div id="map"></div>

<button onclick="toggleForm()">➕ Tambah Fasilitas Kesehatan</button>

<div id="formTambah">
    <h3>Tambah Fasilitas</h3>

    <!-- ACTION DINAMIS SESUAI TABEL -->
    <form method="POST" action="/fasilitas/store">
        @csrf

        <select name="jenis" required>
            <option value="">-- Pilih Jenis Fasilitas --</option>
            <option value="puskesmas">Puskesmas</option>
            <option value="apotik">Apotik</option>
            <option value="klinik">Klinik</option>
            <option value="posyandu">Posyandu</option>
            <option value="kimia_farma">Kimia Farma</option>
        </select>

        <input type="text" name="nama" placeholder="Nama Fasilitas" required>
        <input type="text" name="alamat" placeholder="Alamat" required>
        <input type="text" name="latitude" placeholder="Latitude" required>
        <input type="text" name="longitude" placeholder="Longitude" required>

        <button type="submit">💾 Simpan</button>
    </form>
</div> --}}

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    function toggleForm() {
        const form = document.getElementById('formTambah');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    var map = L.map('map').setView([-10.1772, 123.6070], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    let tempMarker;

    // LOAD SEMUA DATA FASILITAS
    fetch('/fasilitas/json')
        .then(res => res.json())
        .then(data => {
            data.forEach(f => {
                L.marker([f.latitude, f.longitude])
                    .addTo(map)
                    .bindPopup(`
                        <b>${f.nama}</b><br>
                        ${f.alamat}<br>
                        <i>${f.jenis.toUpperCase()}</i><br>
                        <a href="https://www.google.com/maps?q=${f.latitude},${f.longitude}" target="_blank">
                            📍 Google Maps
                        </a>
                    `);
            });
        });

    map.on('click', function(e) {
        document.querySelector('[name=latitude]').value = e.latlng.lat;
        document.querySelector('[name=longitude]').value = e.latlng.lng;

        if (tempMarker) map.removeLayer(tempMarker);

        tempMarker = L.marker(e.latlng)
            .addTo(map)
            .bindPopup('Lokasi dipilih')
            .openPopup();
    });
</script>

</body>
</html>
