<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ForumAnakSurabaya;


class KegiatanForumArekSurabayaController extends Controller
{
    public function HalamanForum() {
      
        $kegiatans = ForumAnakSurabaya::all();
        return view('admin.KegiatanForumArekSurabaya',compact('kegiatans'));
    }

    public function storeForumAnakSurabaya(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('kegiatan-forum-anak-surabaya', $filename, 'public'); // Simpan di storage/public/forum-anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        $tanggal = Carbon::now()->toDateString();

        ForumAnakSurabaya::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh,
            'tanggal' => $tanggal
        ]);

        return redirect()->route('KegiatanForumSurabaya')->with('success', 'Kategori berhasil ditambahkan!');
    }


    
}
