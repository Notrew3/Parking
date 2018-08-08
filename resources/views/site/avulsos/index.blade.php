@extends('site.template.template')
@push('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
@endpush
@section('menu')
@include('site.navbar.navbar')
@endsection

@section('content')

<div class="container">
    @if(session('erro'))
    <div class="alert alert-warning">
        {{session('erro')}}
    </div>
    @endif
    @if(session('carronopatio'))
    <div class="alert alert-warning">
        {{session('carronopatio')}}
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
        <div class="col-lg-3" style=" border-bottom: 2px groove #007BFF;  border-left: 2px groove #007BFF;  border-top: 2px groove #007BFF;  ">
            <h1>Entrada</h1>
            <form class="form-group" method="post" action="{{route('avulso.store')}}">
                {!! csrf_field() !!}
                <input type="hidden" name="patio" value="1">
                <div class="form-group">
                    <label>
                        Placa:
                    </label>
                    <input type="text" name="placa" class="form-control" style="width: 150px;">
                </div>
                <div class="form-group">
                    <label>
                        Carro:
                    </label>
                    <select  name="carro_id" class="form-control" style="width: 150px; height: 35px;">
                        <option value="">Carro</option>
                        @if(isset($carros))
                            @foreach($marcas as $marca)
                            <optgroup label="{{$marca->nome}}" class="form-control">
                                    @foreach($carros as $carro)
                                        @if($carro->marcas_id == $marca->id)
                                            <option value="{{$carro->id}}">{{$carro->nome}}</option>
                                        @endif
                                    @endforeach
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" style="width: 150px;">
                </div>
            </form>
        </div>
        <div class="col-lg-3" style="border-left: 2px groove #007BFF; border-bottom: 2px groove #007BFF; border-top: 2px groove #007BFF;  padding-left: 20px;">
            <h1>Saída</h1>
            <form class="form-group" method="post" action="{{route('avulso.update', 'saida')}}" >
                {!! method_field('PUT') !!}
                {!! csrf_field() !!}
                <input type="hidden" name="patio" value="0">
                <div class="form-group">
                    <label>
                        Placa:
                    </label>
                    <input type="text" name="placa" class="form-control" style="width: 150px;">
                </div>
                <div class="form-group">
                    
                    <input type="hidden" name="carro_id" class="form-control" value="noneedcar">
                </div>
                <div class="form-group">
                    <label>
                        Tabela
                    </label>
                    <select  name="tabela" class="form-control" style="width: 150px; height: 35px;">
                        <option value="">Tabela</option>
                        @if(isset($precos))
                            
                                @foreach($precos as $preco)
                                    
                                        <option value="{{$preco->id}}">{{$preco->nome}}</option>
                                    
                                @endforeach
                           
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" style="width: 150px;">
                </div>
            </form>
        </div>
        <div class="col-lg-6" style="border-left: 2px groove #007BFF; padding-left: 20px;">
            <center><h1>Patio</h1></center>
        <table class="table table-striped">
                <thead>
                    <th>
                        ID
                    </th>
                    <th>
                        Placa
                    </th>
                    <th>
                        Carro
                    </th>
                     <th>
                        Marca
                    </th>
                </thead>
                @if(isset($avulsos))
                    @foreach($avulsos as $avulso)
                    <tr>
                        <td>
                            {{$avulso->id}}
                        </td>
                        <td>
                            {{$avulso->placa}}
                        </td>
                        <td>
                            {{$avulso->carro()['nome']}}
                        </td>
                         <td>
                            {{$avulso->marca($avulso->carro()['marcas_id'])['nome']}}
                        </td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
    
</div>

@endsection