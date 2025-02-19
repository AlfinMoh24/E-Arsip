<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function create($id){
        $dokumen = Dokumen::findOrFail($id);
        return view('user.peminjaman', [
            'dokumen' => $dokumen
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'no_dok' => 'required',
            'nama_dok' => 'required',
            'tgl_ambil' => 'required',
            'tgl_kembali' => 'required'
        ]);

        $validated['user_id'] = Auth::user()->id;
        $validated['file'] = $request['file'];
        // dd($validated);

        Peminjaman::create($validated);

        return redirect()->route('dokumen.index')->with('successDokumen', 'Peminjaman Berhasil Diajukan!');

    }
}
