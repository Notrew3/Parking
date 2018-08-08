@extends('site.template.template')
@push('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link rel="stylesheet" href="{{url('public/assets/clientes/css/style.css')}}">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
@endpush
@section('menu')
@include('site.navbar.navbar')
@endsection

@section('content')
<div class="container">
    
    <h1 class="title-pg">Lista dos Clientes @if(isset($inadimplente)) Devedores @endif</h1>
    <h4>Data de Hoje: {{\Carbon\Carbon::now()->format('d/m/Y') }} @if(isset($inadimplente)) <a href="{{route('clientes.index')}}"><button name="dev" class="btn btn-success">Todos Mensalistas</button></a> @else <a href="devedores/mensalistas"><button name="dev" class="btn btn-warning">Devedores</button></a> @endif</h4>
    <table class="table table-striped">
        <tr class="header-table">
        <th>Id</th>
        <th>Nome</th>
        <th>Mensalidade</th>
        <th>Vencimento</th>
        
        <th>Data de Cadastro</th>
        <th>Ações</th>
    </tr>
    
    @foreach($clientes as $cliente)
   
    
    <tr>
        <td>{{$cliente->id}}</td>
        <td>{{$cliente->nome}}</td>
        <td>{{$cliente->mensalidade}}</td>
        <td>@if($cliente->vencimento)
                {{\Carbon\Carbon::parse($cliente->vencimento)->format('d/m/Y') }}
                
            @endif
        </td>
        
        
        
        <td>
            @if($cliente->created_at)
                {{\Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y H:i:s') }}
            @endif
        </td>
        <td>
            <a href="{{route('clientes.show',$cliente->id)}}"><span class="glyphicon glyphicon-user"></span></a>
            <a href="{{route('clientes.show',$cliente->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
    </tr>
    @endforeach
</table>
   
   
</div>
@endsection

