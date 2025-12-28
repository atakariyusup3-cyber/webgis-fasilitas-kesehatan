<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apotik;

class ApotikController extends Controller
{
    // ===============================
    // TAMPILKAN DATA APOTIK
    // ===============================
    public function index()
    {
        $apotik = Apotik::all();
        return view('apotik.index', compact('apotik'));
    }

    // ===============================
    // FORM TAMBAH APOTIK
    // ===============================
    public function create()
    {
        return view('apotik.create');
    }

    // ===============================
    // SIMPAN DATA APOTIK
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'latitude'  => 'required',
            'longitude' => 'required',
        ]);

        Apotik::create([
            'nama'      => $request->nama,
            'alamat'    => $request->alamat,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('/apotik')
            ->with('success', 'Data apotik berhasil ditambahkan');
    }

    // ===============================
    // DETAIL APOTIK
    // ===============================
    public function show($id)
    {
        $apotik = Apotik::findOrFail($id);
        return view('apotik.show', compact('apotik'));
    }

    // ===============================
    // HAPUS DATA APOTIK
    // ===============================
    public function destroy($id)
    {
        $apotik = Apotik::findOrFail($id);
        $apotik->delete();

        return redirect('/apotik')
            ->with('success', 'Data apotik berhasil dihapus');
    }

    // ===============================
    // DATA JSON UNTUK MAP
    // ===============================
    public function json()
    {
        return response()->json(Apotik::all());
    }
}
