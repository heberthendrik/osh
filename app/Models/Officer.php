<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $table = 'tab_petugas';
    protected $guarded = [];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id_rs');
    }
}
