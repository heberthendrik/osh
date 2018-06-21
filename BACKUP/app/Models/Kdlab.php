<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kdlab extends Model
{
    protected $table = 'tab_kdlab';
    protected $guarded = [];

    public function nrujukan()
    {
        return $this->hasMany(Nrujukan::class, 'id_kdlab');
    }
}
