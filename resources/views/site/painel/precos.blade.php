@extends('site.template.template')
@section('menu')
@include('site.navbar.navbar')
@endsection
@section('content')
<div class="container">
    @if(session('delpreco'))
    <div id="demo" class="alert alert-success">
        {{session('delpreco') }}

    </div>

    @endif
    @if(session('errohora'))
    <div id="demo" class="alert alert-danger">
        {{session('errohora') }}

    </div>

    @endif
    @if( isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    <div class="row">
        <div class="col-lg-6">
            <h1>Criar nova tabela de preços</h1>

            <form class="form-inline" onsubmit="return confirm('Deseja Salvar esta tabela de preços?');"name="enviar" method="post" action="{{route('precos.store')}}">     
                {!! csrf_field() !!}
                <input type="hidden" value="1" name="ativo">
                <label>
                    Tabela:
                </label>
                <input type="text" name="nome" class="form-control" value="{{old('nome')}}">
                <label>
                    Demais Horas:
                </label>
                <input type="number" name="demais" class="form-control" value="{{old('demais')}}"> 
                <input type="submit" value="Criar Tabela"  class="btn btn-primary" style="width:100%; margin-top: 10px;" >
            </form>

        </div>
        <div class="col-lg-6">



            <h1>Inserir preços por hora</h1>
            <form class="form-inline" onsubmit="return confirm('Deseja Salvar este intervalo de horas?');" method="post" action="{{route('preco.store')}}">
                {!! csrf_field() !!}
                <input type="hidden" value="1" name="ativo">
                <select class="form-control" style="height:34px;" name="tabela_preco_id" value="{{old('tabela_preco_id')}}">
                    <option value="">Tabela</option>
                    @if($tabelas)
                    @foreach($tabelas as $tabela)
                    @if($tabela->ativo == 1)
                    <option value="{{$tabela->id}}">{{$tabela->nome}}</option>
                    @endif
                    @endforeach
                    @endif
                </select>
                <label>
                    De
                </label>
                <select class="form-control" name="hora_inicio" style="height:35px;" value="{{old('hora_inicio')}}">
                    <option value="">De</option>
                    @php
                    for($i = 0; $i <= 23; $i++){
                    $minutesH = $i * 60;
                    if($i < 10)
                    $hora = "0".$i ;
                    else
                    $hora = $i;

                    for($j = 0; $j <= 1; $j++){
                    
                    $min = 0;
                    if($j%2){
                    $minutesM = 30;
                    $min = "30";
                    }else{
                    $minutesM = 0;
                    $min = "00";
                    }
                    $minutes = $minutesH + $minutesM;
                    @endphp
                    <option value="{{$minutes}}">{{$hora.':'.$min}}</option>
                    @php
                    }
                    }
                    @endphp
                </select>

                <label>
                    Até
                </label>
                <select class="form-control" name="hora_fim" style="height:35px;" value="{{old('hora_fim')}}">
                    <option value="">Até</option>
                    @php
                    for($i = 0; $i <= 23; $i++){
                    $minutesH = $i * 60;
                    if($i < 10)
                    
                    $hora = "0".$i ;
                    else
                    $hora = $i;

                    for($j = 0; $j <= 1; $j++){

                    $min = 0;
                    if($j%2){
                    $minutesM = 30;
                    $min = "30";
                    }else{
                    $minutesM = 0;
                    $min = "00";
                    }
                    $minutes = $minutesH + $minutesM;
                    @endphp
                    <option value="{{$minutes}}">{{$hora.':'.$min}}</option>
                    @php
                    }
                    }
                    @endphp
                </select>

                <label>Valor</label>
                <input type="number" class="form-control" name="valor" style="width: 130px;" value="{{old('valor')}}" >
                <input type="submit"  value="Inserir"  class="btn btn-primary"style="width:100%; margin-top: 10px;" >
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        @if($tabelas)
        @foreach($tabelas as $tabela)
            @if($tabela->ativo == 1)
        <div class="col-lg-6">            
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <th colspan="4">
                    Tabela de preço: "{{$tabela->nome}}" 
                    <a onclick="return confirm('Deseja deletar a tabela {{$tabela->nome}}?')" href="{{route('precos.show', $tabela->id )}}"><span class="glyphicon glyphicon-trash" style="float:right; color:#c9302c; "></span></a>
                    <span class="glyphicon glyphicon-edit" style="float:right; margin-right: 10px; color: #007BFF;"></span>
                </th>
                </thead>
                <thead>
                <th>
                    De
                </th>
                <th>
                    Até
                </th>
                <th>
                    Valor
                </th>
                <th>
                    Ação
                </th>
                </thead>
                <tbody>

                    @foreach($precos as $preco)
                    @if($preco->tabela_preco_id == $tabela->id && $preco->ativo == 1)
                    <tr>
                        <td>
                            @if($preco->hora_inicio == 0)
                            00:00
                            @else
                            @php
                             if($preco->hora_inicio >= 60){
                             $hora = (int)($preco->hora_inicio / 60);
                             $minutos = $preco->hora_inicio % 60;
                             }else{
                             
                             }
                            @endphp
                                @if($hora < 10 && $minutos < 10)
                                    {{"0".$hora.":0".$minutos}}
                                @else
                                    @if($hora < 10 && $minutos >= 10)
                                        {{"0".$hora.":".$minutos}}
                                    @else
                                        @if($hora >= 10 && $minutos < 10)
                                            {{$hora.":0".$minutos}}
                                        @else
                                            {{$hora.":".$minutos}}
                                        @endif
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($preco->hora_fim == 0)
                            00:00
                            @else
                            @php
                             if($preco->hora_fim >= 60){
                             $hora = (int)($preco->hora_fim / 60);
                             $minutos = $preco->hora_fim % 60;
                             }else{
                             
                             }
                            @endphp
                                @if($hora < 10 && $minutos < 10)
                                    {{"0".$hora.":0".$minutos}}
                                @else
                                    @if($hora < 10 && $minutos >= 10)
                                        {{"0".$hora.":".$minutos}}
                                    @else
                                        @if($hora >= 10 && $minutos < 10)
                                            {{$hora.":0".$minutos}}
                                        @else
                                            {{$hora.":".$minutos}}
                                        @endif
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            R$ {{$preco->valor}},00
                        </td>
                        <td>
                            <a onclick="return confirm('Deseja deletar o intervalo de {{$preco->hora_inicio}} até {{$preco->hora_fim}} ?')" href="{{route('preco.show', $preco->id )}}"><span class="glyphicon glyphicon-trash" style="float: right; color:#c9302c;"></span></a>
                            <a href="{{route('preco.edit', $preco->id)}}"><span class="glyphicon glyphicon-edit" style="float: right; margin-left: 10px; margin-right: 10px;color: #007BFF;"></span></a>                           
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    <tr>
                        <td colspan="4">
                            Demais Horas: R$ {{$tabela->demais}},00
                            
                            <span class="glyphicon glyphicon-edit" style="float: right; color: #007BFF;"></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            @endif
        @endforeach
        @endif
    </div>

</div>
@endsection
@push('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

<style>
    label{
        margin-left: 2px;
        margin-right: 1px;
    }
</style>

@endpush



