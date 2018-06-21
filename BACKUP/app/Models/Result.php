<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public $incrementing = false;

    protected $table = 'tab_lab_master';
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(ResultDetail::class, 'id_master');
    }

    public function histogram()
    {
        return $this->hasOne(ResultHistogram::class, 'id_master');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_dokter');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'id_ruang');
    }
}
