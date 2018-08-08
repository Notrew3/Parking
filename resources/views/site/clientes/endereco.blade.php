@extends('site.template.template')
@section('menu')
@include('site.navbar.navbar')
@endsection
@section('content')
<div class="container">
<h1>Adicione o endereço do cliente: {{$clientes->nome}}</h1>
@if( isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif
<form class="form-group" method="post" action="{{route('endereco.store')}}">
    
    {!! csrf_field() !!}
    <input type="hidden" name="cliente_id" value="{{$clientes->id}}">
    <label>Rua</label>
    <input type="text" name="rua" class="form-control" value="{{old('rua')}}">
    <label>Bairro</label>
    <input type="text" name="bairro" class="form-control" value="{{old('bairro')}}">
    <label>Cidade</label>
    <input type="text" name="cidade" class="form-control" value="{{old('cidade')}}">
    <label>Estado</label>
    <input type="text" name="estado" class="form-control" value="{{old('estado')}}">
    <label>Cep</label>
    <input type="text" name="cep" class="form-control" value="{{old('cep')}}">
    <label>Número</label>
    <input type="text" name="numero" class="form-control" value="{{old('numero')}}">
    <label>Complemento</label>
    <input type="text" name="complemento" class="form-control" value="{{old('complemento')}}">
    <input type="submit" name="submit" class="btn-primary">
    
</form>
</div>
@endsection
@push('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

@endpush
