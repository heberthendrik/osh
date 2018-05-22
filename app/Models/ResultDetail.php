<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultDetail extends Model
{
    public $incrementing = false;

    protected $table = 'tab_lab_detil';
    protected $guarded = [];

    public function kdlab()
    {
        return $this->belongsTo(Kdlab::class, 'id_lab');
    }
}
