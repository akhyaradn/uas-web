<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peserta;
use App\Models\Wisata;
use App\Models\Transportasi;
use App\Models\Penginapan;
use App\Models\Tour;
use App\Models\User;


class TourController extends Controller
{
    public function create(Request $request)
    {
        if(!$request->user()->is_admin) {
            return redirect(route('dashboard'));
        }

        return view('tours.form');
    }

    public function createPost(Request $request)
    {
        $data = $request->all();

        if(array_key_exists('tanggal_mulai', $data) && array_key_exists('tanggal_mulai', $data)) {
            $mulai = strtotime($data['tanggal_mulai']);
            $selesai = strtotime($data['tanggal_selesai']);
            $jarak = ($selesai - $mulai) / 86400;
            
            if($jarak <= 6 && $jarak >= 0) {
                $tour = new Tour();
                $tour->nama = $data['nama'];
                $tour->tanggal_mulai = $mulai;
                $tour->tanggal_selesai = $selesai;
                $tour->user_id = $data['user_id'];
                $tour->save();

                return redirect(url()->previous())->with("success", "Berhasil menambah tour");
            }
        }

        return redirect(url()->previous())->withErrors("Gagal mengubah tour");
    }

    public function update(Request $request, $id)
    {
        if(!$request->user()->is_admin) {
            return redirect(route("dashboard"));
        }        

        $data = Tour::find($id);
        $data->peserta = Peserta::where('tour_id', $id)->get();
        $data->wisata = Wisata::where('tour_id', $id)->get();
        $data->penginapan = Penginapan::where('tour_id', $id)->get();
        $data->transportasi = Transportasi::where('tour_id', $id)->get();

        return view('tours.form', compact('data'));
    }

    public function userView(Request $request, $id)
    {
        $data = Tour::find($id);
        $data->peserta = Peserta::where('tour_id', $id)->get();
        $data->wisata = Wisata::where('tour_id', $id)->get();
        $data->penginapan = Penginapan::where('tour_id', $id)->get();
        $data->transportasi = Transportasi::where('tour_id', $id)->get();

        return view('tours.form', compact('data'));
    }

    public function updatePost(Request $request, $id)
    {
        if(!$request->user()->is_admin) {
            return redirect(route("dashboard"));
        }     

        $tour = Tour::find($id);
        $data = $request->all();

        if(array_key_exists('tanggal_mulai', $data) && array_key_exists('tanggal_mulai', $data)) {
            $mulai = strtotime($data['tanggal_mulai']);
            $selesai = strtotime($data['tanggal_selesai']);
            $jarak = ($selesai - $mulai) / 86400;

            if($jarak <= 6 && $jarak >= 0) {
                $tour->nama = $data['nama'];
                $tour->tanggal_mulai = $mulai;
                $tour->tanggal_selesai = $selesai;
                $tour->user_id = $data['user_id'];
                $tour->save();

                // insert peserta        
                if(array_key_exists('peserta', $data)) {            
                    if(array_key_exists('nama', $data['peserta']) && count($data['peserta']['nama']) > 0) {                
                        Peserta::where('tour_id', $tour->uuid)->delete();
                        $total = count($data['peserta']['nama']);

                        for($i = 0; $i < $total; $i++) {
                            $t = new Peserta();
                            $t->nama = $data['peserta']['nama'][$i];
                            $t->tour_id = $tour->uuid;
                            $t->save();
                        }
                    }
                }

                // insert transportasi        
                if(array_key_exists('transportasi', $data)) {            
                    if(array_key_exists('nama', $data['transportasi']) && count($data['transportasi']['nama']) > 0) {                
                        Transportasi::where('tour_id', $tour->uuid)->delete();
                        $total = count($data['transportasi']['nama']);

                        for($i = 0; $i < $total; $i++) {
                            $t = new Transportasi();
                            $t->nama = $data['transportasi']['nama'][$i];
                            $t->harga_perorang = $data['transportasi']['harga_perorang'][$i];
                            $t->tanggal_mulai = strtotime($data['transportasi']['tanggal_mulai'][$i]);
                            $t->tanggal_selesai = strtotime($data['transportasi']['tanggal_selesai'][$i]);
                            $t->tour_id = $tour->uuid;
                            $t->save();
                        }
                    }
                }

                // insert penginapan        
                if(array_key_exists('penginapan', $data)) {            
                    if(array_key_exists('nama', $data['penginapan']) && count($data['penginapan']['nama']) > 0) {                
                        Penginapan::where('tour_id', $tour->uuid)->delete();
                        $total = count($data['penginapan']['nama']);

                        for($i = 0; $i < $total; $i++) {
                            $t = new Penginapan();
                            $t->nama = $data['penginapan']['nama'][$i];
                            $t->alamat = $data['penginapan']['alamat'][$i];
                            $t->tanggal_checkin = strtotime($data['penginapan']['tanggal_checkin'][$i]);
                            $t->tanggal_checkout = strtotime($data['penginapan']['tanggal_checkout'][$i]);
                            $t->harga_permalam = $data['penginapan']['harga_permalam'][$i];
                            $t->tour_id = $tour->uuid;
                            $t->save();
                        }
                    }
                }

                // insert wisata        
                if(array_key_exists('wisata', $data)) {            
                    if(array_key_exists('nama', $data['wisata']) && count($data['wisata']['nama']) > 0) {                
                        Wisata::where('tour_id', $tour->uuid)->delete();
                        $total = count($data['wisata']['nama']);

                        for($i = 0; $i < $total; $i++) {
                            $t = new Wisata();
                            $t->nama = $data['wisata']['nama'][$i];
                            $t->alamat = $data['wisata']['alamat'][$i];
                            $t->tanggal_berangkat = $data['wisata']['tanggal_berangkat'][$i];
                            $t->harga_tiket = $data['wisata']['harga_tiket'][$i];
                            $t->tour_id = $tour->uuid;
                            $t->save();
                        }
                    }
                }

                return redirect(url()->previous())->with("success", "Berhasil mengubah tour");
            }
        }

        return redirect(url()->previous())->withErrors("Gagal mengubah tour");
    }

    public function tours()
    {
        $data = Tour::get();
        return view('table.tourtable', compact('data'));
    }

    public function deletePost($id)
    {
        Wisata::where('tour_id', $id)->delete();
        Peserta::where('tour_id', $id)->delete();
        Transportasi::where('tour_id', $id)->delete();
        Penginapan::where('tour_id', $id)->delete();
        Tour::find($id)->delete();

        return redirect(route('tours.tours'))->with("success", "Berhasil hapus tour");
    }
}
