<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>WebGIS Fasilitas Kesehatan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <link rel="icon" href="/images/logo.png">

    <style>
        body { margin:0; font-family: Arial, sans-serif; background:#f5f5f5 }
        .header { background:#32c9c6; color:#fff; padding:15px 30px }
        .header h1 { margin:0 }
        .toolbar {
            background:#fff; padding:15px 30px;
            display:flex;
            justify-content: space-between;
            align-items:center;
            box-shadow:0 2px 6px rgba(0,0,0,.1);
        }
        .menu-center { 
            display:flex; 
            gap:10px;
            justify-content: center;
            flex:1;
        }
        .btn {
            padding:10px 16px;
            border-radius:6px;
            background:#2196ab;
            color:#fff;
            font-weight:bold;
            text-decoration:none;
            border:none;
            cursor:pointer;
            white-space: nowrap;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .btn:hover {
            background:#15687a;
            transform: translateY(-2px);
        }
        .btn.gray { 
            background:#be3a3a;
        }
        .btn.gray:hover {
            background:#8b2a2a;
        }
        .map-container {
            padding: 20px;
            background: #f5f5f5;
        }
        #map { 
            height:calc(100vh - 200px); 
            max-height:80vh;
            border: 5px solid #70b6df;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        form { display:inline }
        
        /* Tombol Ulasan */
        .popup-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            background: #87CEEB;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 3px 6px rgba(135, 206, 235, 0.4);
        }
        .popup-btn:hover {
            background: #5DADE2;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(93, 173, 226, 0.5);
        }
        .popup-btn .stars {
            font-size: 16px;
        }
        
        /* Popup styling */
        .leaflet-popup-content {
            margin: 15px;
            min-width: 200px;
        }
        .leaflet-popup-content b {
            font-size: 16px;
            color: #2c3e50;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>WEBGIS FASILITAS KESEHATAN</h1>
    <p>Puskesmas • Apotik • Klinik • Posyandu • Kimia Farma</p>
</div>

<div class="toolbar">
    <div style="width: 100px;"></div>
    
    <div class="menu-center">
        <a href="/puskesmas" class="btn">Puskesmas</a>
        <a href="/apotik" class="btn">Apotik</a>
        <a href="/klinik" class="btn">Klinik</a>
        <a href="/posyandu" class="btn">Posyandu</a>
        <a href="/kimia-farma" class="btn">Kimia Farma</a>
    </div>

    <form method="POST" action="/logout" style="width: 100px; text-align: right;">
        @csrf
        <button type="submit" class="btn gray">Logout</button>
    </form>
</div>

<div class="map-container">
    <div id="map"></div>
</div>

<script>
/* ================= MAP INIT ================= */
const map = L.map('map').setView([-10.1772, 123.6070], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

const layer = L.layerGroup().addTo(map);

/* ================= ICON ================= */
function markerIcon(color) {
    return L.icon({
        iconUrl: 'data:image/svg+xml;base64,' + btoa(`
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="45">
                <path d="M16 0C9 0 4 5 4 12c0 8 12 28 12 28s12-20 12-28c0-7-5-12-12-12z" fill="${color}"/>
                <circle cx="16" cy="12" r="6" fill="white"/>
            </svg>
        `),
        iconSize:[32,45],
        iconAnchor:[16,45]
    });
}

const icons = {
    puskesmas: markerIcon('#43a047'),
    apotik: markerIcon('#e53935'),
    klinik: markerIcon('#8e24aa'),
    posyandu: markerIcon('#fbc02d'),
    kimia_farma: markerIcon('#1e88e5')
};

/* ================= FOCUS LOCATION ================= */
function focusLocation(lat, lng) {
    map.setView([lat, lng], 17); // zoom ke lokasi
}

/* ================= LOAD SEMUA DATA ================= */
function loadAllData() {
    layer.clearLayers();

    const sources = [
        { url:'/puskesmas/json', jenis:'puskesmas' },
        { url:'/apotik/json', jenis:'apotik' },
        { url:'/klinik/json', jenis:'klinik' },
        { url:'/posyandu/json', jenis:'posyandu' },
        { url:'/kimia-farma/json', jenis:'kimia_farma' }
    ];

    sources.forEach(src => {
        fetch(src.url)
            .then(res => res.json())
            .then(data => {
                data.forEach(d => {
                    if(!d.latitude || !d.longitude) return;

                    L.marker([d.latitude, d.longitude], { icon: icons[src.jenis] })
                        .addTo(layer)
                        .bindPopup(`
                            <b>${d.nama}</b><br>
                            📍 ${d.alamat}<br>
                            <small>${src.jenis.toUpperCase()}</small><br><br>

                            <div style="display:flex; gap:5px;">
                                <a href="https://www.google.com/maps?q=${d.latitude},${d.longitude}"
                                   class="popup-btn" target="_blank">
                                   <span class="stars">⭐⭐</span>
                                   <span>Ulasan</span>
                                </a>
                            </div>
                        `);
                });
            });
    });
}

/* ================= AUTO LOAD ================= */
loadAllData();
</script>

</body>
</html>