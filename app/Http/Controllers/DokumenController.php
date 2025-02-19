<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Dokumen;
use App\Models\Map;
use App\Models\rak;
use App\Models\Ruang;
use App\Models\Urut;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;



class DokumenController extends Controller
{

    public function index()
    {
        // dd(Dokumen::orderBy('nama_dok', 'asc')->get());
        return view('admin.dokumen.index', [
            'title' => 'Dokumen',
            'dokumens' => Dokumen::orderBy('nama_dok', 'asc')->with(['rak', 'ruang', 'map', 'box', 'urut'])->get(),

        ]);
    }


    public function create()
    {
        return view('admin.dokumen.create', [
            'raks' => rak::all(),
            'ruangs' => Ruang::all(),
            'maps' => Map::all(),
            'boxs' => Box::all(),
            'uruts' => Urut::all()
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_dok' => 'required|max:225|unique:dokumens',
            'kode_dok' => 'required|max:225|unique:dokumens',
            'nama_dok' => 'required|max:225',
            'rak_id' => 'required',
            'ruang_id' => 'required',
            'box_id' => 'required',
            'map_id' => 'required',
            'urut_id' => 'required',
            'deskripsi' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,gif,svg|max:10240',
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $filename = $validated['kode_dok'] . '.' . $extension;

        // $validated['file'] = $request->file('file')->storeAs('data-dokumen', $filename, 'public'); jika ingin public

        $validated['file'] = $filename;

        $validated['ukuran'] = round($file->getSize() / 1024, 2);
        $request->file('file')->storeAs('data-dokumen', $filename);
        $request->file('file')->move(public_path('data-dokumen'), $filename);
        Dokumen::create($validated);

        return redirect()->route('dokumen.index')->with('successDokumen', 'Dokumen Berhasil Ditambah!');
    }


    public function show(string $id) {}


    public function edit(string $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('admin.dokumen.edit', [
            'dokumen' => $dokumen,
            'raks' => rak::all(),
            'ruangs' => Ruang::all(),
            'maps' => Map::all(),
            'boxs' => Box::all(),
            'uruts' => Urut::all()
        ]);
    }


    public function update(Request $request, $id)
    {
        // Validasi request, cek unik hanya jika no_dok atau kode_dok berubah
        $dokumen = Dokumen::findOrFail($id);
        // dd($dokumen);
        $validated = $request->validate([
            'no_dok' => [
                'required',
                'max:225',
                Rule::unique('dokumens')->ignore($dokumen->id),
            ],
            'kode_dok' => [
                'required',
                'max:225',
                Rule::unique('dokumens')->ignore($dokumen->id),
            ],
            'nama_dok' => 'required|max:225',
            'rak_id' => 'required',
            'ruang_id' => 'required',
            'map_id' => 'required',
            'box_id' => 'required',
            'urut_id' => 'required',
            'deskripsi' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,gif,svg|max:10240',
        ]);

        // Cek apakah ada file baru yang diunggah
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = $validated['kode_dok'] . '.' . $extension;

            // Hapus file lama jika ada
            if ($dokumen->file) {
                Storage::delete($dokumen->file);
            }

            // Simpan file baru
            $validated['file'] = $filename;
            $validated['ukuran'] = round($file->getSize() / 1024, 2);
            $file->storeAs('/data-dokumen', $filename);
        }

        // Update hanya data yang berubah
        $dokumen->update($validated);

        return redirect()->route('dokumen.index')->with('successDokumen', 'Dokumen berhasil diperbarui.');
    }



    public function destroy(string $id) {
        Dokumen::findOrFail($id);
        Dokumen::where('id', $id)->delete();

        return redirect()->route('dokumen.index')->with('successDokumen', 'Hapus Berhasil!');
    }
}
