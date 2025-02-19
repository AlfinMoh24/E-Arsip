<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function riwayat()
    {
        return view('admin.transaksi.riwayat', [
            'title' => 'Riwayat Pengembalian',
            'peminjamans' => Peminjaman::with('user')->get()

        ]);
    }
    public function approval()
    {
        $peminjaman = Peminjaman::where('approval', 'pending')->with('user')->get();
        // dd($peminjaman);
        return view('admin.transaksi.approval', [
            'title' => 'Approval Peminjaman',
            'peminjamans' => $peminjaman

        ]);
    }
    public function pengembalian()
    {
        $peminjaman = Peminjaman::where('approval', 'approved')
            ->where('tgl_pengembalian', '-')
            ->get();

        return view('admin.transaksi.pengembalian', [
            'title' => 'Pengembalian Peminjaman',
            'peminjamans' => $peminjaman

        ]);
    }

    public function updateApproval(Request $request, $id){

        Peminjaman::where('id', $id)->update(['approval'=> $request->approval]);
        return redirect()->route('approval')->with('successTransaksi', 'Approval ' . $request->approval);
    }

    public function updatePengembalian($id){
        Peminjaman::where('id', $id)->update(['tgl_pengembalian'=> now()->format('d-m-Y')]);
        return redirect()->route('pengembalian')->with('successTransaksi', 'Pengembalian Terkonfimasi');
    }
}
