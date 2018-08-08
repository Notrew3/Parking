<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Carros;
use App\Models\Marcas;

class Avulso extends Model
{
    protected $guarded = [];
    
    public function carro(){
        $carro = new Carros;
        $car = $carro->find($this->carro_id);
        return $car;
    }
    
     public function marca($id){
        $marca = new Marcas;
        $mark = $marca->find($id);
        return $mark;
    }
}
