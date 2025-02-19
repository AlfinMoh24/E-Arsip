<?php

namespace App\Exports;

use App\Models\Dokumen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DokumenExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dokumen::with(['ruang','rak', 'box', 'map', 'urut' ])->get()->map(function($dokumen){
            return [
                'Nomor Dokumen' => $dokumen->no_dok,
                'Nama Dokumen'  => $dokumen->nama_dok,
                'Ukuran (KB)'   => $dokumen->ukuran . ' KB',
                'Tanggal Upload' => $dokumen->created_at->format('Y-m-d'),
                'Lokasi' =>
                    ($dokumen->ruang->ruang ?? '') . '.' .
                    ($dokumen->rak->rak ?? '') . '.' .
                    ($dokumen->box->box ?? '') . '.' .
                    ($dokumen->map->map ?? '') . '.' .
                    ($dokumen->urut->urut ?? ''),
            ];
        });
    }
    public function headings(): array
    {
        return ["Nomor Dokumen", "Nama Dokumen", "Ukuran (KB)", "Tanggal Upload", "Lokasi"];
    }
}
