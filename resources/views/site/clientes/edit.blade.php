@extends('site.template.template')
@section('menu')
@include('site.navbar.navbar')
@endsection
@section('content')
<div class="container">
<h1>Nome : {{$cliente->nome}}</h1>
<h2>Mensalidade : R${{$cliente->mensalidade}},00</h2>
<h3>Vencimento : {{\Carbon\Carbon::parse($cliente->vencimento)->format('d/m/Y')}}</h3>
@if($cliente->address['rua'])
    Rua: {{$cliente->address['rua']}}, #{{$cliente->address['numero']}} - {{$cliente->address['complemento']}}<br>
    {{$cliente->address['bairro']}}, {{$cliente->address['cidade']}} - {{$cliente->address['estado']}}
@else
<a href="{{route('endereco.edit', $cliente->id)}}">Adicionar Endereço</a>
@endif
</div>
@endsection
@push('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
@endpush

