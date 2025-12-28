<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puskesmas;

class PuskesmasController extends Controller
{
    // Menampilkan daftar Puskesmas
    public function index()
    {
        $puskesmas = Puskesmas::all();
        return view('puskesmas.index', compact('puskesmas'));
    }

    // Menampilkan form tambah Puskesmas
    public function create()
    {
        return view('puskesmas.create');
    }

    // Menyimpan data Puskesmas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Puskesmas::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('/puskesmas')
            ->with('success', 'Puskesmas berhasil ditambahkan');
    }

    // Menampilkan detail Puskesmas
    public function show($id)
    {
        $puskesmas = Puskesmas::findOrFail($id);
        return view('puskesmas.show', compact('puskesmas'));
    }

    // JSON untuk peta
    public function json()
    {
        return response()->json(Puskesmas::all());
    }

    // ✅ HAPUS DATA PUSKESMAS
    public function destroy($id)
    {
        Puskesmas::findOrFail($id)->delete();

        return redirect('/puskesmas')
            ->with('success', 'Data Puskesmas berhasil dihapus');
    }
}
