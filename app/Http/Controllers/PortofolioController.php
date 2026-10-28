<?php

namespace App\Http\Controllers;

use App\Models\Portofolio_1100;
use App\Models\Skill_1100;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    // Halaman 1: CV / Dashboard Publik
    public function index()
    {
        $portofolios = Portofolio_1100::with('skill')->latest()->get();
        $skills = Skill_1100::all();
        return view('dashboard', compact('portofolios', 'skills'));
    }

    // Halaman 2: Form Input & Kelola CRUD
    public function admin()
    {
        $portofolios = Portofolio_1100::with('skill')->latest()->get();
        $skills = Skill_1100::all();
        return view('admin', compact('portofolios', 'skills'));
    }

    public function storePortofolio(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only(['judul', 'deskripsi', 'skill_id']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('portofolio', 'public');
        }

        Portofolio_1100::create($data);
        return redirect()->route('admin')->with('success', 'Portofolio Berhasil Ditambahkan!');
    }

    public function updatePortofolio(Request $request, $id)
    {
        $item = Portofolio_1100::findOrFail($id);
        $data = $request->only(['judul', 'deskripsi', 'skill_id']);

        if ($request->hasFile('gambar')) {
            if ($item->gambar) {
                Storage::disk('public')->delete($item->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('portofolio', 'public');
        }

        $item->update($data);
        return redirect()->route('admin')->with('success', 'Portofolio Berhasil Diperbarui!');
    }

    public function destroyPortofolio($id)
    {
        $item = Portofolio_1100::findOrFail($id);
        if ($item->gambar) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();
        return redirect()->route('admin')->with('success', 'Portofolio Berhasil Dihapus!');
    }

    public function storeSkill(Request $request)
    {
        $request->validate(['nama_skill' => 'required', 'tingkat' => 'required']);
        Skill_1100::create($request->all());
        return redirect()->route('admin')->with('success', 'Skill Berhasil Ditambahkan!');
    }

    public function destroySkill($id)
    {
        Skill_1100::destroy($id);
        return redirect()->route('admin')->with('success', 'Skill Berhasil Dihapus!');
    }
}
