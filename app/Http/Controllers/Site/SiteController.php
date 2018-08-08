<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;

class SiteController extends Controller
{
    public function index() {
        
        return view('site.home.index');        
    }
    public function contato($contato = ""){
        return view('site.contato.index', compact('contato'));
    }
    
}
