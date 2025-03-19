<?php

namespace App\Http\Controllers;

use App\Models\SubKegiatan; // Pastikan model ini benar
use Illuminate\Http\Request;

class KlasterController extends Controller
{
    // Method untuk "Hak Sipil dan Kebebasan"
    public function haksipildankebebasan()
    {
        // Query data dari model SubKegiatan
        $datas = SubKegiatan::where('is_active', true)
            ->whereHas('klaster', function ($query) {
                $query->where('nama', 'Hak Sipil dan Kebebasan');
            })
            ->get();

        // Kirim data ke Blade view
        return view('frontend.content.HakSipilDanKebebasan', compact('datas'));
    }

    // Method untuk "Kelembagaan"
    public function kelembagaan()
    {
        $datas = SubKegiatan::where('is_active', true)
            ->whereHas('klaster', function ($query) {
                $query->where('nama', 'Kelembagaan');
            })
            ->get();

        return view('frontend.content.kelembagaan', compact('datas'));
    }

    // Method untuk "Kesehatan Dasar dan Kesejahteraan"
    public function kesehatandasar()
    {
        $datas = SubKegiatan::where('is_active', true)
            ->whereHas('klaster', function ($query) {
                $query->where('nama', 'Kesehatan Dasar dan Kesejahteraan');
            })
            ->get();

        return view('frontend.content.KesehatanDasar', compact('datas'));
    }

    // Method untuk "Lingkungan Keluarga dan Pengasuhan Alternatif"
    public function lingkungankeluarga()
    {
        $datas = SubKegiatan::where('is_active', true)
            ->whereHas('klaster', function ($query) {
                $query->where('nama', 'Lingkungan Keluarga dan Pengasuhan Alternatif');
            })
            ->get();

        return view('frontend.content.LingkunganKeluarga', compact('datas'));
    }

    // Method untuk "Pendidikan, Pemanfaatan Waktu Luang dan Kegiatan Budaya"
    public function pendidikanpemanfaatan()
    {
        $datas = SubKegiatan::where('is_active', true)
            ->whereHas('klaster', function ($query) {
                $query->where('nama', 'Pendidikan, Pemanfaatan Waktu Luang dan Kegiatan Budaya');
            })
            ->get();

        return view('frontend.content.PendidikanPemanfaatan', compact('datas'));
    }

    // Method untuk "Perlindungan Khusus"
    public function perlindungankhusus()
    {
        $datas = SubKegiatan::where('is_active', true)
            ->whereHas('klaster', function ($query) {
                $query->where('nama', 'Perlindungan Khusus');
            })
            ->get();

        return view('frontend.content.PerlindunganKhusus', compact('datas'));
    }
}
