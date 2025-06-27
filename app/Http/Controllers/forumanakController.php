<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\DokumenKecamatan;
use App\Models\DokumenKelurahan;
use App\Models\ForumAnakSurabaya;
use App\Models\PemantauanUsulan;
use App\Models\SuaraAnak;
use App\Models\JenisSurat;
class forumanakController extends Controller
{
    /**
     * Menampilkan data SK FAS Kecamatan yang aktif.
     */
    public function skkec()
    {
        $dataAktif = DokumenKecamatan::whereHas('surat', function ($query) {
                $query->where('nama', 'SK FAS');
            })->where('is_active', true) ->get();

        return view('frontend.content.SkFasKecamatan', compact('dataAktif'));
    }

    public function skkel() {
        
        // $documents = skkel::paginate(10);
        $dataAktif = DokumenKelurahan::whereHas('surat', function ($query) {
            $query->where('nama', 'SK FAS');
        })->where('is_active', true) ->get();
        
        return view('frontend.content.SkFasKelurahan', compact('dataAktif')); 
    }

    public function pemantauananak()
    {
        // $documents = skkel::paginate(10);
        $datas = SuaraAnak::where('is_active', true)->get();
        return view('frontend.content.Pemantauananak',compact('datas')); 
    }

    public function kegareksby()
    {
        $dataAktif = ForumAnakSurabaya::where('is_active', true)->get();

        // Kirim data ke view
        return view('frontend.content.kegareksby', compact('dataAktif')); 
    }

    public function kegiatanforumanakkelurahan()
    {
        $dataAktif = ForumAnakSurabaya::where('is_active', true)
        ->where('dibuatOleh', 19) // Role ID kelurahan
        ->get();
        return view('frontend.content.KegiatanForumAnakKelurahan', compact('dataAktif')); 
    }


    public function kegiatanforumanakkecamatan()
    {
        $dataAktif = ForumAnakSurabaya::where('is_active', true)
                ->where('dibuatOleh', 18) // Role ID kecamatan
                ->get();

        return view('frontend.content.KegiatanForumAnakKecamatan', compact('dataAktif'));

    }
}
