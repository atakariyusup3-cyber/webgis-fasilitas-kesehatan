<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KimiaFarma;

class KimiaFarmaController extends Controller
{
    // ===============================
    // TAMPILKAN DATA KIMIA FARMA
    // ===============================
    public function index()
    {
        $kimiafarma = KimiaFarma::all();
        return view('kimia_farma.index', compact('kimiafarma'));
    }

    // ===============================
    // FORM TAMBAH KIMIA FARMA
    // ===============================
    public function create()
    {
        return view('kimia_farma.create');
    }

    // ===============================
    // SIMPAN DATA KIMIA FARMA (FIX ERROR LONGITUDE)
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // BERSIHKAN KOMA & SPAASI (PENTING)
        $latitude  = str_replace([',', ' '], '', $request->latitude);
        $longitude = str_replace([',', ' '], '', $request->longitude);

        KimiaFarma::create([
            'nama'      => $request->nama,
            'alamat'    => $request->alamat,
            'latitude'  => $latitude,
            'longitude' => $longitude,
        ]);

        return redirect('/kimia-farma')
            ->with('success', 'Data Kimia Farma berhasil ditambahkan');
    }

    // ===============================
    // DETAIL KIMIA FARMA
    // ===============================
    public function show($id)
    {
        $kimiaFarma = KimiaFarma::findOrFail($id);
        return view('kimia_farma.show', compact('kimiaFarma'));
    }

    // ===============================
    // HAPUS DATA KIMIA FARMA
    // ===============================
    public function destroy($id)
    {
        $kimiaFarma = KimiaFarma::findOrFail($id);
        $kimiaFarma->delete();

        return redirect('/kimia-farma')
            ->with('success', 'Data Kimia Farma berhasil dihapus');
    }

    // ===============================
    // DATA JSON UNTUK MAP
    // ===============================
    public function json()
    {
        return response()->json(KimiaFarma::all());
    }
}
