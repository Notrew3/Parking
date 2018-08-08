<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Marcas;

class Carros extends Model
{
    protected $guarded = [];
    
    public function marca(){
        $marcas = new Marcas;
        $marcas = $this->hasOne('App\Models\Marcas');
        return $marcas;
    }
}
