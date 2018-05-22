<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'tab_dokter';
    protected $guarded = [];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id_rs');
    }
}
