<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TabelaPreco;
use App\Models\Preco;
use App\Http\Requests\Site\TabelaPrecoFormRequest;

class TabelaPrecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $tabelapreco;
    
    public function __construct(TabelaPreco $tabelapreco, Preco $preco) {
        $this->tabelapreco = $tabelapreco;
        $this->preco = $preco;
    }
    public function index()
    {
        $tabelas = $this->tabelapreco->all()->sortBy('nome');
        $precos = $this->preco->all();
        
        return view('site.painel.precos', compact('tabelas', 'precos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TabelaPrecoFormRequest $request)
    {
        $dataForm = $request->except('_token','submit');
        $exist = $this->tabelapreco->where('nome', $dataForm['nome'])->first();
        if($exist){
            $delpreco = "Tabela de preço recuperada!";
            $exist->update([
                'ativo' => 1,
                'demais' => $dataForm['demais']
            ]);
            
            return redirect()->route('precos.index')->with('delpreco', $delpreco);
        }else{
        //Valida os dados
        //$this->validate($request, $this->address->rules);
        
        //insere no banco
        $insert = $this->tabelapreco->create($dataForm);
        
        if($insert){
            $delpreco = "Tabela de preço Criada!";
            return redirect()->route('precos.index')->with('delpreco', $delpreco);
        }else
            return "Nao Cadastrado";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tabela = $this->tabelapreco->where('id', $id)->update([
            'ativo' => 0
        ]);                
        $preco = $this->preco->all()->where('tabela_preco_id', $id);
        foreach($preco as $p){
            $p->update([
                'ativo' => 0
            ]);
        }
        
        
        if($tabela){
            $delpreco = "Tabela Excluida!";
            return redirect()->route('precos.index')->with('delpreco', $delpreco);
        }else{
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
