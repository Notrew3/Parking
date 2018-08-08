<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Avulso;
use App\Models\Carros;
use App\Models\Marcas;
use App\Models\Cupom;
use App\Models\Preco;
use App\Models\TabelaPreco;
use App\Http\Requests\Site\AvulsoFormRequest;
use Carbon\Carbon;

class AvulsoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $avulso;

    public function __construct(Avulso $avulso) {
        $this->avulso = $avulso;
    }

    public function index(Carros $carro, Marcas $marca, TabelaPreco $preco) {
        $avulsos = $this->avulso->all()->where('patio', 1);
        $marcas = $marca->all()->sortBy('nome');
        $carros = $carro->all()->sortBy('nome');
        $precos = $preco->all()->where('ativo', 1)->sortBy('nome');
        return view('site.avulsos.index', compact('carros', 'marcas', 'avulsos','precos'));
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
    public function store(AvulsoFormRequest $request) {
        $dataForm = $request->except('_token', 'submit');

        $patio = $this->avulso->where('placa', $dataForm['placa'])
                        ->where('patio', 1)->first();

        if ($patio) {
            $erro = 'Carro já esta no patio!';
            return redirect()->back()->with('carronopatio', $erro);
            //return view('site.avulsos.index', compact('erro'));
        } else {
            $insert = $this->avulso->create($dataForm);
        }
        if ($insert) {
            $cupom = new Cupom;
            $atributes = ['avulsos_id' => $insert->id];
            $cupom->create($atributes);
            return view('site.avulsos.cupomentrada', compact('insert'));
        } else
            return "Nao Cadastrado";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AvulsoFormRequest $request, $id) {
        $avulso = $this->avulso->where('placa', $request->placa)
                        ->where('patio', 1)->first();


        $update = $this->avulso
                ->where('placa', $request->placa)
                ->where('created_at', $avulso['updated_at'])
                ->update([
            'patio' => 0
        ]);

        if ($update) {
            $av = $this->avulso->find($avulso->id);
            $cupom = new Cupom;            
            $dateI = Carbon::parse($av->created_at);            
            $dateF = Carbon::parse($av->updated_at);
            $estadia = $dateF->diffInMinutes($dateI);           
            $idtabelapreco = $request->tabela;
            $tabela = new TabelaPreco;
            $nomeTabela = $tabela->where('id', $request->tabela)->first();
            $preco = new Preco;
            $p = $preco->all()->where('tabela_preco_id', $idtabelapreco)->where('ativo', 1); //Collection {#286 ▼  #items: array:5 [▶]
            foreach ($p as $ps) {
                
                if ($estadia >= $ps->hora_inicio && $estadia <= $ps->hora_fim) {
                    $avs = $this->avulso->find($avulso->id);
                    $precoTotal = $ps->valor;
                    $upCupom = $cupom->where('avulsos_id', $avulso->id)
                            ->update([
                                'tabela_preco_id' => $nomeTabela->id,
                                'precos_id' => $ps->id,
                                'estadia' => $estadia,
                                'valor' => $precoTotal
                            ]);
                    $erro = 'tabela: '. $nomeTabela->nome . ' estadia: ' . $estadia . ' Hora: ' . $ps->hora_inicio . ' #' . $ps->id . ' Preco da estadia: ' . $ps->valor;
                    return view('site.avulsos.cupomsaida', compact('avs', 'precoTotal'));
                }else{
                
                    $diferenca = $estadia - $ps->hora_fim;
                    $horasMais = (int)($diferenca / 60);
                    if($horasMais == 0){
                        $horasMais = 1;
                    }
                    $precoTotal = $ps->valor + ($nomeTabela->demais * $horasMais);
                    $erro = 'tabela: '. $nomeTabela->nome . ' estadia: ' . $estadia . ' Hora: ' . $ps->hora_inicio . ' #' . $ps->id . ' Preco da estadia: ' . $precoTotal;
                }
                
            }
            $avs = $this->avulso->find($avulso->id);
            $upCupom = $cupom->where('avulsos_id', $avulso->id)
                            ->update([
                                'tabela_preco_id' => $nomeTabela->id,
                                'precos_id' => $ps->id,
                                'estadia' => $estadia,
                                'valor' => $precoTotal
                            ]);
            return view('site.avulsos.cupomsaida', compact('avs', 'precoTotal'));

            /* $cupom->where('avulsos_id', $av->id)->update([
              'tabela_preco_id' => 1,
              'preco_id' => 1,
              'estadia' => 1,
              'valor' => 1
              ]); */
        } else {
            $erro = 'Carro não está no patio!';

            return redirect('avulso')->with('erro', $erro);
        }
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

}
