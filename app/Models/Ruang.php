<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $guarded = ['id'];
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'ruang_id', 'id');
    }
}
