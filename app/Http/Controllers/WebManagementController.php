<?php

namespace App\Http\Controllers;

use view;
use App\Models\OPD;
use App\Models\Galeri;
use App\Models\Slider;
use App\Models\Artikel;
use App\Models\Halaman;
use App\Models\Klaster;
use App\Models\ForumAnak;
use App\Models\JenisSurat;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;
use App\Models\KategoriArtikel;
use App\Models\PemantauanUsulan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WebManagementController extends Controller
{
    //=====================CRUD SLider
    //tampilkan data
    public function slider() {
        $sliders = Slider::orderBy('created_at', 'desc')->get();
        return view('admin.Slider', compact('sliders'));
    }

    // Simpan gambar
    public function storeSlider(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:500',
            'deskripsi' => 'required|string|max:500',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'caption.required' => 'Caption wajib diisi.',
            'caption.max' => 'Caption maksimal 500 karakter.',
            
            'gambar.required' => 'Gambar wajib diunggah.',
            'gambar.mimes' => 'Gambar harus berformat PNG, JPG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',
        ]);
    
        
        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('slider', $filename, 'public'); // Simpan di storage/public/slider
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }
    
        Slider::create([
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh,
            'gambar' => 'storage/' . $path, 
        ]);
    
        return redirect()->route('slider')->with('success', 'Slider berhasil ditambahkan!');
    }

    public function updateSlider(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:500',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'is_active' => 'required|in:0,1',
        ], [
            'nama.unique' => 'Nama kategori sudah digunakan, silakan pilih yang lain.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'caption.required' => 'Caption wajib diisi.',
            'caption.max' => 'Caption maksimal 500 karakter.',
            
            'gambar.required' => 'Gambar wajib diunggah.',
            'gambar.mimes' => 'Gambar harus berformat PNG, JPG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);
    
        $slider = Slider::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($slider->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $slider->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $slider->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('slider', $gambarName, 'public');
            $path = $photo->storeAs('slider', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $slider->update($data);
    
        return redirect()->route('slider')->with('success', 'Slider berhasil diperbarui!');
    }

    public function destroySlider($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $slider->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }
        
        $slider->delete();

        return redirect()->route('slider')->with('success', 'Slider berhasil dihapus!');
    }
    
    //====================================END CRUD SLider











    //===========CRUD Sub Kegiatan
    public function subKegiatan() 
    {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $subKegiatans = SubKegiatan::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $subKegiatans = SubKegiatan::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        $klasters = Klaster::where('is_active', true)->get();
        return view('admin.SubKegiatan', compact('subKegiatans','klasters'));
    }

    public function storeSubKegiatan(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'klusterid' => 'required|integer', 
            'dataPendukung' => 'required|mimes:pdf|max:10048', 
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|in:0,1', 
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan maksimal 500 karakter.',
            
            'dataPendukung.required' => 'Data Pendukung wajib diunggah.',
            'dataPendukung.mimes' => 'Data Pendukung harus berformat PDF, DOC, atau DOCX.',
            'dataPendukung.max' => 'Ukuran Data Pendukung maksimal 10 MB.',
            
        ]);
    
        $file = $request->file('dataPendukung');
        $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('sub-kegiatan', $filename, 'public'); // Disimpan di storage/app/public/sub-kegiatan
    
        SubKegiatan::create([
            'nama' => $request->nama,
            'klusterid' => $request->klusterid,
            'keterangan' => $request->keterangan,
            'dataPendukung' => 'storage/' .$path,
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh, 
        ]);
    
        return redirect()->route('sub-kegiatan')->with('success', 'Sub Kegiatan berhasil ditambahkan!');
    }    

    public function updateSubKegiatan(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'klusterid' => 'required|integer', 
            'dataPendukung' => 'mimes:pdf|max:10048', 
            'keterangan' => 'required|string|max:500',
            'is_active' => 'required|in:0,1', 
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan maksimal 500 karakter.',
        
            'dataPendukung.mimes' => 'Data Pendukung harus berformat PDF, DOC, atau DOCX.',
            'dataPendukung.max' => 'Ukuran Data Pendukung maksimal 10 MB.',
            
        ]);
    
        $kegiatan = SubKegiatan::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'klusterid' => $request->klusterid,
            'keterangan' => $request->keterangan,
            'is_active' => $request->is_active,
        ];
    
                // Jika ada file baru
                if ($request->hasFile('dataPendukung')) {
                    // Hapus FILE lama jika ada
                    if ($kegiatan->dataPendukung) {
                        // Hapus FILE berdasarkan path lengkap yang disimpan di database
                        if (Storage::exists(str_replace('storage/', 'public/', $kegiatan->dataPendukung))) {
                            Storage::delete(str_replace('storage/', 'public/', $kegiatan->dataPendukung));
                        }
                    }
                    // Simpan FILE baru dengan nama format "YYYY-MM-DD-nama-baru.PDF"
                    $file = $request->file('dataPendukung');
                    $fileName = date('Y-m-d-His') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('sub-kegiatan', $fileName, 'public');
                    $path = $file->storeAs('sub-kegiatan', $fileName, 'public');
        
                    // Simpan nama FILE baru ke database
                    $data['dataPendukung'] = 'storage/' . $path;
                }                
    
        // Update kegiatan
        $kegiatan->update($data);
    
        return redirect()->route('sub-kegiatan')->with('success', 'Sub Kegiatan berhasil diperbarui!');
    }

    public function destroySubKegiatan($id)
    {
        $subkegiatan = SubKegiatan::findOrFail($id);

        if ($subkegiatan->dataPendukung) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $subkegiatan->dataPendukung);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $subkegiatan->delete();

        return redirect()->route('sub-kegiatan')->with('success', 'Sub Kegiatan berhasil dihapus!');
    }
    //===========END CRUD Sub Kegiatan











    //===========CRUD FORUMANAK
    public function forumAnak() {
        $forumAnaks = ForumAnak::orderBy('created_at', 'desc')->get();
        return view('admin.ForumAnak', compact('forumAnaks'));
    }

    public function storeForumAnak(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'caption.required' => 'Caption wajib diisi.',
            'caption.max' => 'Caption maksimal 500 karakter.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',
            
            'gambar.required' => 'gambar wajib diunggah.',
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('forum-anak', $filename, 'public'); // Simpan di storage/public/forum-anak
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        ForumAnak::create([
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('forum-anak')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateForumAnak(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'gambar' => 'mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'caption.required' => 'Caption wajib diisi.',
            'caption.max' => 'Caption maksimal 500 karakter.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',
            
            
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]);
    
        $forum = ForumAnak::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($forum->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $forum->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $forum->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('slider', $gambarName, 'public');
            $path = $photo->storeAs('slider', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $forum->update($data);
    
        return redirect()->route('forum-anak')->with('success', 'Forum Anak berhasil diperbarui!');
    }

    public function destroyForumAnak($id)
    {
        $forum = ForumAnak::findOrFail($id);

        if ($forum->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $forum->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }
        
        $forum->delete();

        return redirect()->route('forum-anak')->with('success', 'Forum Anak berhasil dihapus!');
    }
    //===========CRUD FORUMANAK
    













    //=============== CRUD Galeri
    public function galeri() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $galeris = Galeri::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $galeris = Galeri::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('admin.Galeri', compact('galeris'));
    }

    public function storeGaleri(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'caption.required' => 'Caption wajib diisi.',
            'caption.max' => 'Caption maksimal 500 karakter.',
            
            'gambar.required' => 'Gambar wajib diunggah.',
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('galeri', $filename, 'public'); // Simpan di storage/public/galeri
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        Galeri::create([
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('galeri')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateGaleri(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'gambar' => 'mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            
            'caption.required' => 'Caption wajib diisi.',
            'caption.max' => 'Caption maksimal 500 karakter.',
            
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]);

        $galeri = Galeri::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'caption' => $request->caption,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($galeri->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $galeri->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $galeri->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('galeri', $gambarName, 'public');
            $path = $photo->storeAs('galeri', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $galeri->update($data);
    
        return redirect()->route('galeri')->with('success', 'Galeri Anak berhasil diperbarui!');
    }

    public function destroyGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $galeri->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $galeri->delete();

        return redirect()->route('galeri')->with('success', 'Galeri berhasil dihapus!');
    }
     //=================END CRUD Galeri








    //=================CRUD KategoriArtikel
    public function kategoriArtikel() {
        $kategori_artikel = KategoriArtikel::orderBy('created_at', 'desc')->get();
        return view('admin.KategoriArtikel', compact('kategori_artikel'));
    }   

    public function storeKategoriArtikel(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_artikel,nama',
            'is_active' => 'required|boolean',
        ],[
            'nama.unique' => 'Nama kategori sudah digunakan, silakan pilih yang lain.',
        ]);
        KategoriArtikel::create($request->all());

        return redirect()->route('kategoriArtikel')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateKategoriArtikel(Request $request, $id)
    {
    $request->validate([
        'nama' => 'required|string|max:255|unique:kategori_artikel,nama,' . $id,
        'is_active' => 'required|boolean',
    ], [
        'nama.unique' => 'Nama kategori sudah digunakan, silakan pilih yang lain.',
    ]);

    $kategori = KategoriArtikel::findOrFail($id);

    $data = [
        'nama' => $request->nama,
        'is_active' => $request->is_active
    ];

    $kategori->update( $data );

    return redirect()->route('kategoriArtikel')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroyKategoriArtikel($id)
    {
        $kategori = KategoriArtikel::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategoriArtikel')->with('success', 'Kategori berhasil dihapus!');
    }
    

    //============================END CRUD KategoriArtikel












    //================= CRUD klaster
    public function klaster1() {
        $klasters = Klaster::orderBy('created_at', 'desc')->get();
        return view('admin.Klaster', compact('klasters'));
       
    }
    public function storeKlaster(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_artikel,nama',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'icon' => 'required|string|max:30',
            'is_active' => 'required|boolean',
        ],[
            'nama.unique' => 'Nama Klaster ini sudah digunakan, silakan pilih yang lain.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'icon.required' => 'icon wajib diisi.',
            'icon.max' => 'icon maksimal 30 karakter.',
            
            'gambar.required' => 'gambar wajib diunggah.',
            'gambar.mimes' => 'Dat Pendukung harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('klaster', $filename, 'public'); // Simpan di storage/public/klaster
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        // dd($path);
        $slug='/';
        Klaster::create([
            'nama' => $request->nama,
            'icon' => $request->icon,
            'slug' => $slug,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('Klaster')->with('success', 'Kategori berhasil ditambahkan!');
    }

    
    public function updateKlaster(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_artikel,nama',
            'gambar' => 'mimes:png,jpg,jpeg|max:2048',
            'icon' => 'required|string|max:30',
            'is_active' => 'required|boolean',
        ],[
            'nama.unique' => 'Nama Klaster ini sudah digunakan, silakan pilih yang lain.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'icon.required' => 'icon wajib diisi.',
            'icon.max' => 'icon maksimal 30 karakter.',
            
            'gambar.mimes' => 'Dat Pendukung harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]);
    
        $klaster = Klaster::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'icon' => $request->icon,
            'is_active' => $request->is_active,
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($klaster->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $klaster->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $klaster->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('klaster', $gambarName, 'public');
            $path = $photo->storeAs('klaster', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $klaster->update($data);
    
        return redirect()->route('Klaster')->with('success', 'Klaster berhasil diperbarui!');
    }

    public function destroyKlaster($id)
    {
        $klaster = Klaster::findOrFail($id);
        
        if ($klaster->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $klaster->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $klaster->delete();

        return redirect()->route('Klaster')->with('success', 'Klaster berhasil dihapus!');
    }
     //=================END CRUD klaster


     //=================CRUD PemantauanUsulan
    public function pemantauanUsulan() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data
            $usulans = PemantauanUsulan::orderBy('created_at', 'desc')->get();
        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $usulans = PemantauanUsulan::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->get();
        }
        $opds = OPD::where('is_active', 1)->get();
        return view('admin.PemantauanUsulan',compact('usulans','opds')); 
    }

    public function storepemantauanUsulan(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'namaUsulan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:500',
            'tindakLanjut' => 'required|string|max:500',
        ],
        [
            'namaUsulan.required' => 'Nama Usulan wajib diisi.',
            'namaUsulan.max' => 'Nama Usulan maksimal 255 karakter.',
            
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan maksimal 500 karakter.'
            
        ]);

        $is_active = 1;
        PemantauanUsulan::create([
            'namaUsulan' => $request->namaUsulan,
            'keterangan' => $request->keterangan,
            'is_active' =>  $is_active,
            'userid' => $request->userid,
            'opdId' => (int) $request->opdId,
            'tindakLanjut' => $request->tindakLanjut
        ]);

        return redirect()->route('PemantauanUsulanAnak')->with('success', 'Usulan berhasil ditambahkan!');
    }

    public function updatePemantauanUsulan(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'namaUsulan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:500',
            'tindakLanjut' => 'required',
        ],
        [
            'namaUsulan.required' => 'Nama Usulan wajib diisi.',
            'namaUsulan.max' => 'Nama Usulan maksimal 255 karakter.',
            
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan maksimal 500 karakter.',
            
            'tindakLanjut.required' => 'Harus ada',
        ]);

        $usulan = PemantauanUsulan::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'namaUsulan' => $request->namaUsulan,
            'keterangan' => $request->keterangan,
            'tindakLanjut' => $request->tindakLanjut,
            'is_active' => $request->is_active,
            'opdId' => $request->opdId,
        ];

        // Update 
        $usulan->update($data);
    
        return redirect()->route('PemantauanUsulanAnak')->with('success', 'Usulan berhasil diperbarui!');
    }

    public function destroyPemantauan($id)
    {
        $pemantauan = PemantauanUsulan::findOrFail($id);

        $pemantauan->delete();

        return redirect()->route('PemantauanUsulanAnak')->with('success', 'Pemantauan berhasil dihapus!');
    }
     //=================END CRUD PemantauanUsulan


     //=================CRUD Halaman
    public function bagianHalaman() {
        $halamans = Halaman::orderBy('created_at', 'desc')->get();
        return view('admin.HalamanWebMan',compact(('halamans'))); 
    }
    public function storeHalaman(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'konten' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ],
        [
            'judul.required' => 'judul wajib diisi.',
            'judul.max' => 'judul maksimal 255 karakter.',
            
            'konten.required' => 'konten wajib diisi.',
            'konten.max' => 'konten maksimal 500 karakter.',
            
            'gambar.required' => 'gambar wajib diunggah.',
            'gambar.mimes' => 'Dat Pendukung harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]);

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('halaman', $filename, 'public'); // Simpan di storage/public/halaman
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        // dd($path);
        $slug ='/';
        Halaman::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'slug' => $slug,
            'gambar' => 'storage/' . $path, 
            'is_active' => $request->is_active,
            'dibuatOleh' => $request->dibuatOleh
        ]);

        return redirect()->route('Halamandong')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateHalaman(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'mimes:png,jpg,jpeg|max:2048',
            'konten' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ],
        [
            'judul.required' => 'judul wajib diisi.',
            'judul.max' => 'judul maksimal 255 karakter.',
            
            'konten.required' => 'konten wajib diisi.',
            'konten.max' => 'konten maksimal 500 karakter.',

            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]);
    
        $halaman = Halaman::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'is_active' => $request->is_active,
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($halaman->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $halaman->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $halaman->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('halaman', $gambarName, 'public');
            $path = $photo->storeAs('halaman', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $halaman->update($data);
    
        return redirect()->route('Halamandong')->with('success', 'Halaman berhasil diperbarui!');
    }

    public function destroyHalaman($id)
    {
        $halaman = Halaman::findOrFail($id);
        $halaman->delete();

        if ($halaman->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $halaman->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        return redirect()->route('Halamandong')->with('success', 'Halaman berhasil dihapus!');
    }
    //================== END CRUD Halaman 


    //================== CRUD Artikel
    public function bagianArtikel() {
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $user->hasPermissionTo('super admin-Full Control')) {
            // Jika user punya izin 'super admin', ambil semua data

           $artikels = Artikel::orderBy('created_at', 'desc')->get();

        } else {
            // Jika bukan 'super admin', hanya ambil data yang dibuat oleh user
            $artikels = Artikel::whereHas('user', function ($query) {
                    $query->where('name', Auth::user()->name);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        $kategoris = KategoriArtikel::where('is_active', true)->get();
        $klasters = Klaster::where('is_active', true)->get();
        $subKegiatans = SubKegiatan::where('is_active', true)->get();
        return view('admin.Artikel', compact('artikels','kategoris','subKegiatans','klasters'));

    }
    public function storeArtikel(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'subkegiatanid' => 'required|integer',
            'konten' => 'required|string|max:500',
            'kategoriartikelid' => 'required|integer',
            'is_active' => 'required|boolean',
        ],
        [
            'judul.required' => 'judul wajib diisi.',
            'judul.max' => 'judul maksimal 255 karakter.',
            
            'konten.required' => 'konten wajib diisi.',
            'konten.max' => 'konten maksimal 500 karakter.',

            'tag.required' => 'tag wajib diisi.',
            'tag.max' => 'tag maksimal 100 karakter.',
            
            'gambar.required' => 'Gambar wajib diunggah.',
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]
    );

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $filename = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('artikel', $filename, 'public'); // Simpan di storage/public/artikel
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        // dd($path);
        $slug ='/';
        Artikel::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'tag' => $request->tag,
            'gambar' => 'storage/' . $path, 
            'subkegiatanid' => $request->subkegiatanid,
            'konten' => $request->konten,
            'kategoriartikelid' => $request->kategoriartikelid,
            'dibuatOleh' => $request->dibuatOleh,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('Artikel')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateArtikel(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'gambar' => 'mimes:png,jpg,jpeg|max:2048',
            'subkegiatanid' => 'required|integer',
            'konten' => 'required|string|max:500',
            'kategoriartikelid' => 'required|integer',
            'is_active' => 'required|boolean',
        ],
        [
            'judul.required' => 'judul wajib diisi.',
            'judul.max' => 'judul maksimal 255 karakter.',
            
            'konten.required' => 'konten wajib diisi.',
            'konten.max' => 'konten maksimal 500 karakter.',

            'tag.required' => 'tag wajib diisi.',
            'tag.max' => 'tag maksimal 100 karakter.',
            
            'gambar.mimes' => 'Gambar harus berformat JPG, PNG, atau JPEG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            
        ]
    );
    
        $artikel = Artikel::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'tag' => $request->tag,
            'subkegiatanid' => $request->subkegiatanid,
            'kategoriartikelid' => $request->kategoriartikelid,
            'is_active' => $request->is_active,
        ];
    
        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($artikel->gambar) {
                // Hapus gambar berdasarkan path lengkap yang disimpan di database
                if (Storage::exists(str_replace('storage/', 'public/', $artikel->gambar))) {
                    Storage::delete(str_replace('storage/', 'public/', $artikel->gambar));
                }
            }
            // Simpan gambar baru dengan nama format "YYYY-MM-DD-nama-baru.jpg"
            $photo = $request->file('gambar');
            $gambarName = date('Y-m-d-His') . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('artikel', $gambarName, 'public');
            $path = $photo->storeAs('artikel', $gambarName, 'public');

            // Simpan nama gambar baru ke database
            $data['gambar'] = 'storage/' . $path;
        }
    
        // Update slider
        $artikel->update($data);
    
        return redirect()->route('Artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroyArtikel($id)
    {
        $artikel = Artikel::findOrFail($id);
    
        // Hapus gambar jika ada
        if ($artikel->gambar) {
            // Konversi path dari 'storage/' ke 'public/' untuk Storage::delete
            $filePath = str_replace('storage/', 'public/', $artikel->gambar);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }
    
        // Hapus artikel dari database
        $artikel->delete();
    
        return redirect()->route('Artikel')->with('success', 'Artikel berhasil dihapus!');
    }
    
    //================== END CRUD Artikel


    public function ManagementMenu() {
        return view('admin.MenuManagement'); 
    }

    //=======================OPD CRUD
    public function opd() {
        $opds = OPD::orderBy('created_at', 'desc')->get();
        return view('admin.opd', compact('opds'));
       
    }

    public function opdAPI()
    {
        $opds = OPD::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data OPD retrieved successfully',
            'data' => $opds
        ], 200);
    }

    
    //tambah
    public function storeOPD(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255|unique:opd,nama',
            'is_active' => 'required|boolean',
        ],
        [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'nama.unique' => 'Gagal menambahkan OPD ini sudah ada.',

            'is_active.required' => 'Status wajib dipilih.',
            'is_active.boolean' => 'Status wajib diisi.',
        ]
    );

    

        OPD::create([
            'nama' => $request->nama,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('opd')->with('success', 'OPD berhasil ditambahkan!');
    }

    public function storeOPDAPI(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:opd,nama',
                'is_active' => 'required|boolean',
            ], [
                'nama.required' => 'Nama wajib diisi.',
                'nama.max' => 'Nama maksimal 255 karakter.',
                'nama.unique' => 'Gagal menambahkan OPD, karena sudah ada.',

                'is_active.required' => 'Status wajib dipilih.',
                'is_active.boolean' => 'Status harus bernilai true atau false.',
            ]);

            $opd = OPD::create($validated);

            return response()->json([
                'message' => 'OPD berhasil ditambahkan.',
                'data' => $opd,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //edit
    public function updateOPD(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ],
        [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'nama.unique' => 'Gagal menambahkan OPD ini sudah ada.',

            'is_active.required' => 'Status wajib dipilih.',
            'is_active.boolean' => 'Status wajib diisi.',
        ]
    );

    
        $opd = OPD::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'is_active' => $request->is_active,
        ];
    
        // Update 
        $opd->update($data);
    
        return redirect()->route('opd')->with('success', 'OPD berhasil diperbarui!');
    }

    public function updateOPDAPI(Request $request, $id)
    {
        try {
            // Cari OPD berdasarkan ID
            $opd = OPD::findOrFail($id);

            // Validasi data request
            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:opd,nama,' . $id,
                'is_active' => 'required|boolean',
            ], [
                'nama.required' => 'Nama wajib diisi.',
                'nama.max' => 'Nama maksimal 255 karakter.',
                'nama.unique' => 'Gagal memperbarui OPD, nama sudah digunakan.',
                'is_active.required' => 'Status wajib dipilih.',
                'is_active.boolean' => 'Status harus bernilai true atau false.',
            ]);

            // Update data OPD
            $opd->update($validated);

            return response()->json([
                'message' => 'OPD berhasil diperbarui.',
                'data' => $opd,
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    //delete
    public function destroyOPD($id)
    {
        $opd = OPD::findOrFail($id);
    
        // Hapus dari database
        $opd->delete();
    
        return redirect()->route('opd')->with('success', 'OPD berhasil dihapus!');
    }

    public function destroyOPDAPI($id)
    {
        try {
            // Cari OPD berdasarkan ID
            $opd = OPD::findOrFail($id);

            // Hapus OPD
            $opd->delete();

            return response()->json([
                'message' => 'OPD berhasil dihapus.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

        //=======================END OPD CRUD

        //=======================surat CRUD
        public function suratJenis() {
            $surats = JenisSurat::orderBy('created_at', 'desc')->get();
            return view('admin.surat', compact('surats'));
           
        }

        public function storeSuratJenis(Request $request)
        {
            $request->validate([
                'nama' => 'required|string|max:255|unique:jenis_surat,nama',
                'is_active' => 'required|boolean',
            ], [
                'nama.required' => 'Nama wajib diisi.',
                'nama.max' => 'Nama maksimal 255 karakter.',
                'nama.unique' => 'Gagal menambahkan Surat ini sudah ada, silakan pilih yang lain.',
        
                'is_active.required' => 'Status wajib dipilih.',
                'is_active.boolean' => 'Status wajib diisi.',
            ]);
        
            JenisSurat::create([
                'nama' => $request->nama,
                'is_active' => $request->is_active,
            ]);
        
            return redirect()->route('suratJenis')->with('success', 'Jenis Surat berhasil ditambahkan!');
        }
        

    public function updatesuratJenis(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'nama.unique' => 'Gagal menambahkan Surat ini sudah ada, silakan pilih yang lain.',
    
            'is_active.required' => 'Status wajib dipilih.',
            'is_active.boolean' => 'Status wajib diisi.',
        ]);

    
        $opd = JenisSurat::findOrFail($id);
    
        // Simpan data baru
        $data = [
            'nama' => $request->nama,
            'is_active' => $request->is_active,
        ];
    
        // Update 
        $opd->update($data);
    
        return redirect()->route('suratJenis')->with('success', 'Surat Jenis berhasil diperbarui!');
    }
    public function destroysuratJenis($id)
    {
        $opd = JenisSurat::findOrFail($id);
    
        // Hapus dari database
        $opd->delete();
    
        return redirect()->route('suratJenis')->with('success', 'Surat berhasil dihapus!');
    }
}
