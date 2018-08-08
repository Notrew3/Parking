@extends('site.template.template')
@section('menu')
@include('site.navbar.navbar')
@endsection
@section('content')
@if( isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
     @if(session('errohora'))
    <div id="demo" class="alert alert-danger">
        {{session('errohora') }}

    </div>

    @endif
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <center><h2>Tabela: {{$tabela->nome}}</h2></center>
<form class="form-inline" onsubmit="return confirm('Deseja Editar este intervalo de horas?');" method="post" action="{{route('preco.update', $preco->id)}}">
                {!!method_field('PUT')!!}
                {!! csrf_field() !!}
                <input type="hidden" value="1" name="ativo">
                
                <input type="hidden" class="form-control"  name="tabela_preco_id" value="{{$tabela->id}}">
                    
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
                    <option value="{{$minutes}}" @if(isset($preco) && $preco->hora_inicio == $minutes) selected @endif>{{$hora.':'.$min}}</option>
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
                    <option value="{{$minutes}}" @if(isset($preco) && $preco->hora_fim == $minutes) selected @endif>{{$hora.':'.$min}}</option>
                    @php
                    }
                    }
                    @endphp
                </select>

                <label>Valor</label>
                <input type="number" class="form-control" name="valor" style="width: 130px;" value="{{$preco->valor or old('valor')}}" >
                <input type="submit"  value="Editar"  class="btn btn-primary"style="width:100%; margin-top: 10px;" >
            </form>
    </div>
    <div class="col-lg-4"></div>
</div>
@endsection
@push('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
@endpush

