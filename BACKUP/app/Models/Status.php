<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'tab_status';
    protected $guarded = [];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id_rs');
    }
}
