<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tab_barang';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id_rs');
    }
}
