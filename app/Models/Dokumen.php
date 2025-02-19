<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $guarded = ['id'];

    public function rak()
    {
        return $this->belongsTo(rak::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function box()
    {
        return $this->belongsTo(Box::class);
    }

    public function urut()
    {
        return $this->belongsTo(Urut::class);
    }
}

