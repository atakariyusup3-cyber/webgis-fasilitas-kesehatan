<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posyandu;

class PosyanduController extends Controller
{
    // ===============================
    // INDEX
    // ===============================
    public function index()
    {
        $posyandu = Posyandu::all();
        return view('posyandu.index', compact('posyandu'));
    }

    // ===============================
    // CREATE
    // ===============================
    public function create()
    {
        return view('posyandu.create');
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

        Posyandu::create([
            'nama'      => $request->nama,
            'alamat'    => $request->alamat,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('/posyandu')
            ->with('success', 'Posyandu berhasil ditambahkan');
    }

    // ===============================
    // SHOW
    // ===============================
    public function show($id)
    {
        $posyandu = Posyandu::findOrFail($id);
        return view('posyandu.show', compact('posyandu'));
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy($id)
    {
        Posyandu::findOrFail($id)->delete();

        return redirect('/posyandu')
            ->with('success', 'Posyandu berhasil dihapus');
    }

    // ===============================
    // JSON (MAP)
    // ===============================
    public function json()
    {
        return response()->json(Posyandu::all());
    }
}
