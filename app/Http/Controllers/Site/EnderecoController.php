<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Address;
use \App\Http\Requests\Site\AddressFormRequest;
class EnderecoController extends Controller
{
    private $address;
    
    public function __construct(Address $address) {
        $this->address = $address;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressFormRequest $request)
    {
        $dataForm = $request->except('_token','submit');
        //Valida os dados
        //$this->validate($request, $this->address->rules);
        
        //insere no banco
        $insert = $this->address->create($dataForm);
        
        if($insert)
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Cliente $cliente)
    {
        $clientes = $cliente->find($id);
        $title = 'Adicionando Endereço';
        return view('site.clientes.endereco', compact('clientes','title'));
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
        //
    }
}
