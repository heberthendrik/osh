<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'tab_customer';
    protected $guarded = [];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id_rs');
    }
}
