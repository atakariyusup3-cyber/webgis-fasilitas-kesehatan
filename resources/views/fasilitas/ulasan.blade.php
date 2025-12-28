<h1>{{ $fasilitas->nama }}</h1>
<p>📍 {{ $fasilitas->alamat }}</p>

<h3>Ulasan Pengguna</h3>

@if($ulasan->count() > 0)
    <ul>
        @foreach($ulasan as $u)
            <li>
                <strong>{{ $u->nama_pengguna }}</strong>: {{ $u->komentar }}
            </li>
        @endforeach
    </ul>
@else
    <p>Belum ada ulasan.</p>
@endif

<a href="https://www.google.com/maps?q={{ $fasilitas->latitude }},{{ $fasilitas->longitude }}" target="_blank">Lihat Lokasi di Maps</a>
