@extends('site.template.template')
@section('menu')
@include('site.navbar.navbar')
@endsection
@section('content')
<div class="container">

    @if( isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    <div class="row">
        <div class="col-lg-6">
            <h1>Cadastrar novo carro</h1>
            <form class="form-group" method="post" action="{{route('carros.store')}}">

                {!! csrf_field() !!}
                <div class="form-group">
                    <label>Carro</label>
                    <input type="text" name="nome" class="form-control" value="{{old('nome')}}">
                </div>
                <div class="form-group">
                    <label>
                        Marca
                    </label>
                    <select  name="marcas_id" class="form-control" style="width: 150px; height: 35px;">
                        <option value="" selected>Marca</option>
                        @if($marcas)
                        @foreach($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->nome}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>    
                <input type="submit" name="submit" class="btn btn-primary">    
            </form>
        </div>
        <div class="col-lg-6">
            <h1>Cadastrar nova marca</h1>
            <form class="form-group" method="post" action="{{route('marcas.store')}}">

                {!! csrf_field() !!}
                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" name="nome" class="form-control" value="{{old('nome')}}">
                </div>
                
                <input type="submit" name="submit" class="btn btn-primary">    
            </form>
        </div>
    </div>
</div>
    @endsection
    @push('head')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    @endpush

