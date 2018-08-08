<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TabelaPreco;
use App\Http\Services\PrecoService;
use App\Models\Preco;
use App\Http\Requests\Site\PrecoFormRequest;

class PrecoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $preco;
    private $tabela;

    public function __construct(Preco $preco, TabelaPreco $tabela) {
        $this->preco = $preco;
        $this->tabela = $tabela;
    }

    public function index() {
        return "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrecoFormRequest $request) {
        $dataForm = $request->except('_token', 'submit');
        $precos = $this->preco->all()->where('tabela_preco_id', $dataForm['tabela_preco_id']);
        $services = new PrecoService;
        $errohora = $services->validaHorario($dataForm, $precos);
        if (isset($errohora)) {
            return redirect()->back()->with('errohora', $errohora);
        } else {
            $exist = $this->preco
                    ->where('tabela_preco_id', $dataForm['tabela_preco_id'])
                    ->where('hora_inicio', $dataForm['hora_inicio'])
                    ->where('hora_fim', $dataForm['hora_fim'])
                    ->first();
            if ($exist) {
                $delpreco = "Intervalo de horas recuperado!";
                $exist->update([
                    'ativo' => 1,
                    'valor' => $dataForm['valor']
                ]);

                return redirect()->route('precos.index')->with('delpreco', $delpreco);
            } else {
                $insert = $this->preco->create($dataForm);

                if ($insert){
                    $delpreco = "Intervalo de horas criado!";
                    return redirect()->route('precos.index')->with('delpreco', $delpreco);
                }else
                    return "Nao Cadastrado";
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $preco = $this->preco->where('id', $id)->update([
            'ativo' => 0
        ]);

        if ($preco) {
            $delpreco = "Intervalo desativado!";
            return redirect()->route('precos.index')->with('delpreco', $delpreco);
        } else {
            $errohora = "Algum erro aconteceu!";
            return redirect()->route('precos.index')->with('errohora', $errohora);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $preco = $this->preco->find($id);
        $tabela = $this->tabela->where('id', $preco->tabela_preco_id)->first();

        return view('site.painel.intervaloedit', compact('preco', $preco, 'tabela', $tabela));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrecoFormRequest $request, $id) {
        $dataForm = $request->except('_method', '_token', 'submit');
        $preco = $this->preco->find($id);
        $preco->update([
            'ativo' => 0
        ]);
        $precos = $this->preco->all()->where('tabela_preco_id', $dataForm['tabela_preco_id']);
        $services = new PrecoService;
        $errohora = $services->validaHorario($dataForm, $precos);
        if (isset($errohora)) {
            return redirect()->back()->with('errohora', $errohora);
        } else {
            $update = $preco->update($dataForm);
        }
        if ($update) {
            $delpreco = "Intervalo Editado com sucesso!";
            return redirect()->route('precos.index')->with('delpreco', $delpreco);
        } else {
            $errohora = "Intervalo Não editado, algum erro ocorreu!";
            return redirect()->route('precos.index')->with('errohora', $errohora);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
    }

}
