<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Preco;

class TabelaPreco extends Model
{
    protected $guarded = [];
    
    public function preco(){
        
        return $this->hasMany('App\Models\Preco');
    }
}
