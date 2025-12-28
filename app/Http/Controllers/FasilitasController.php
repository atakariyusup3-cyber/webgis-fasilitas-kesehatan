<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puskesmas;
use App\Models\Apotik;
use App\Models\Klinik;
use App\Models\Posyandu;
use App\Models\KimiaFarma;
use App\Models\Ulasan; // pastikan ada model ulasan

class FasilitasController extends Controller
{
    public function json()
    {
        return response()->json(
            collect()
                ->merge(Puskesmas::select('id','nama','alamat','latitude','longitude')->get()->map(function($d){
                    return array_merge($d->toArray(), ['jenis'=>'puskesmas']);
                }))
                ->merge(Apotik::select('id','nama','alamat','latitude','longitude')->get()->map(function($d){
                    return array_merge($d->toArray(), ['jenis'=>'apotik']);
                }))
                ->merge(Klinik::select('id','nama','alamat','latitude','longitude')->get()->map(function($d){
                    return array_merge($d->toArray(), ['jenis'=>'klinik']);
                }))
                ->merge(Posyandu::select('id','nama','alamat','latitude','longitude')->get()->map(function($d){
                    return array_merge($d->toArray(), ['jenis'=>'posyandu']);
                }))
                ->merge(KimiaFarma::select('id','nama','alamat','latitude','longitude')->get()->map(function($d){
                    return array_merge($d->toArray(), ['jenis'=>'kimia_farma']);
                }))
        );
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'jenis'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'latitude'=>'required',
            'longitude'=>'required'
        ]);

        // Ganti match dengan switch supaya kompatibel PHP <8
        switch($data['jenis']) {
            case 'puskesmas':
                $model = Puskesmas::class;
                break;
            case 'apotik':
                $model = Apotik::class;
                break;
            case 'klinik':
                $model = Klinik::class;
                break;
            case 'posyandu':
                $model = Posyandu::class;
                break;
            case 'kimia_farma':
                $model = KimiaFarma::class;
                break;
            default:
                abort(404);
        }

        $model::create($data);

        return back()->with('success','Data berhasil disimpan');
    }

    // ================= ULASAN =================
    public function ulasan($jenis, $id)
    {
        // Pilih model sesuai jenis
        switch($jenis) {
            case 'puskesmas':
                $model = Puskesmas::class;
                break;
            case 'apotik':
                $model = Apotik::class;
                break;
            case 'klinik':
                $model = Klinik::class;
                break;
            case 'posyandu':
                $model = Posyandu::class;
                break;
            case 'kimia_farma':
                $model = KimiaFarma::class;
                break;
            default:
                abort(404);
        }

        // Ambil data fasilitas
        $fasilitas = $model::findOrFail($id);

        // Ambil ulasan terkait fasilitas
        $ulasan = Ulasan::where('fasilitas_id', $id)
                         ->where('jenis_fasilitas', $jenis)
                         ->get();

        return view('fasilitas.ulasan', compact('fasilitas','ulasan'));
    }
}
