<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $table = 'tab_ruang';
    protected $guarded = [];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id_rs');
    }
}
