@extends('site.template.template')
@section('menu')
@include('site.navbar.navbar')
@endsection
@section('content')
<div class="container">
<h1>Cadastrar novo cliente</h1>
@if( isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif
<form class="form-group" method="post" action="{{route('clientes.store')}}">
    
    {!! csrf_field() !!}
    <div class="form-group">
    <label>Nome</label>
    <input type="text" name="nome" class="form-control" value="{{old('nome')}}">
    </div>
    <div class="form-group">
    <label>Mensalidade</label>
    <input type="text" name="mensalidade" class="form-control" value="{{old('mensalidade')}}">
    </div>
    <div class="form-group">
    <label>Vencimento</label>
    <input type="date" name="vencimento" class="form-control" value="{{old('vencimento')}}">
    </div>
    <input type="submit" name="submit" class="btn btn-primary">
    
</form>
</div>
@endsection
@push('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
@endpush
