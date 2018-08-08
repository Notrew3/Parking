<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrecoService
 *
 * @author Positivo
 */
namespace App\Http\Services;

class PrecoService {
    
    public function validaHorario($dataForm , $precos){
        
        foreach($precos as $preco){
           $formhinicio = $dataForm['hora_inicio'];
           $bdhinicio = $preco->hora_inicio;
           $formhfim = $dataForm['hora_fim'];
           $bdhfim = $preco->hora_fim;
           if($formhinicio > $formhfim){
               $errohora = "A hora de entrada nao pode ser maior que a hora de saida!";
               return $errohora;
              //return redirect()->back()->with('errohora',$errohora);
             //return  view('site.painel.precos', compact('errohora'));
           }         
           if($formhinicio < $bdhfim && $preco->ativo == 1 ){
               $errohora = "O horario escolhido já está sendo utilizado";
                       
              return $errohora;
               //return redirect()->back()->with('errohora',$errohora);
             //return  view('site.painel.precos', compact('errohora'));
           }
            
        }
    }
}
