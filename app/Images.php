<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table='images';

    public function galery()
    {
        return $this->belongsTo('App\Galery','galery_id');
    }
}
