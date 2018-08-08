<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use \App\Http\Requests\Site\ClienteFormRequest;

class ClientesController extends Controller {

    private $cliente;

    public function __construct(Cliente $cliente) {
        $this->cliente = $cliente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function devedores(Cliente $cliente) {

        $clientes = $this->cliente->all();

        return view('site.clientes.index', compact('clientes'));
    }

    public function index(Cliente $cliente, $devedores = null) {
        $inadimplente = $devedores;
        $clientes = $this->cliente->all();
        if (isset($inadimplente)) {
            $clientes = $this->cliente->all()->where('vencimento', '<=', date('Y-m-d H:i:s'));
            return view('site.clientes.index', compact('clientes', 'inadimplente'));
        } else {
            return view('site.clientes.index', compact('clientes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('site.clientes.cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteFormRequest $request) {
        $dataForm = $request->except('_token', 'submit');

//valida o form
        /* //this->validate($request, $this->cliente->rules);
          $validate = validator($dataForm, $this->cliente->rules, $this->cliente->messages);
          if($validate->fails()){
          return redirect()
          ->route('clientes.create')
          ->withErrors($validate)
          ->withInput();
          }

         */
        //faz o cadastro
        $insert = $this->cliente->create($dataForm);

        if ($insert)
            return redirect()->route('clientes.index');
        else
            return "Nao Cadastrado";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $cliente = $this->cliente->find($id);
        $title = "Perfil do Mensalista";
        return view('site.clientes.edit', compact('cliente', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function tests() {
        /*
         * Insere no banco
          $cliente = $this->cliente;
          $cliente->nome = "Ewerton Azevedo";
          $cliente->mensalidade = 200;
          $insert = $cliente->save();

          if($insert){
          return 'Inserido com sucesso';
          } else {
          return 'erro ao inserir';
          }
         */
        /* $insert = $this->cliente->create([
          'nome' => 'Nome Cliente 4',
          'mensalidade' => 130
          ]);
          if($insert){
          return "Inserido com sucesso Id {$insert->id}";
          } else {
          return 'erro ao inserir';
          }

         */
        //Update
        /* $cliente = $this->cliente->find(5);
          $cliente->nome = 'Update';
          $upd = $cliente->save();

          if($upd){
          return "Alterado!";
          }else{
          return "Erro ao alterar!";
          }
         */
        //Update2
        /*
          $cliente = $this->cliente->find(5);
          $upd = $cliente->update([
          'nome' => 'Upteste',
          'mensalidade' => '350'
          ]);
          if($upd){
          return "Alterado!";
          }else{
          return "Erro ao alterar!";
          }
         */
        $cliente = $this->cliente->find(5);
        $delete = $cliente->delete();
        if ($delete) {
            return "Deletado!";
        } else {
            return "Nao Deletado!";
        }
    }

}
