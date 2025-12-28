<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klinik;

class KlinikController extends Controller
{
    // ===============================
    // INDEX
    // ===============================
    public function index()
    {
        $klinik = Klinik::all();
        return view('klinik.index', compact('klinik'));
    }

    // ===============================
    // CREATE
    // ===============================
    public function create()
    {
        return view('klinik.create');
    }

    // ===============================
    // STORE
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Klinik::create([
            'nama'      => $request->nama,
            'alamat'    => $request->alamat,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('/klinik')
            ->with('success', 'Klinik berhasil ditambahkan');
    }

    // ===============================
    // SHOW
    // ===============================
    public function show($id)
    {
        $klinik = Klinik::findOrFail($id);
        return view('klinik.show', compact('klinik'));
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy($id)
    {
        Klinik::findOrFail($id)->delete();

        return redirect('/klinik')
            ->with('success', 'Klinik berhasil dihapus');
    }

    // ===============================
    // JSON (MAP)
    // ===============================
    public function json()
    {
        return response()->json(Klinik::all());
    }
}
