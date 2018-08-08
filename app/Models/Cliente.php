<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Address;

class Cliente extends Model
{
    protected $fillable = ['nome', 'mensalidade', 'vencimento', 'created_at', 'updated_at'];
   
    
    
   public function setDateFormat($format = 'd-m-Y')
    {
        $this->dateFormat = $format;

        return $this;
    }
  
    public function address(){
        $addrs = new Address;
        $addrs = $this->hasOne('App\Address');
        return $addrs;
    }
}
