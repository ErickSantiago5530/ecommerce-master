@extends('layouts.app')

@section('content')
<div class="container text-center ">
  <div class="card product text-left">
    {{-- {{ $product }} --}}

    <h1>{{ $product->titulo }}</h1>
    <div class="row">
      <div class="col-sm-6 col-xs-12">

      </div>
      <div class="col-sm-6 col-xs-12">
        <p>Descripcion</p>
        <p>{{ $product->descripcion}}</p>
        <p> @include("in_shopping_carts.form",['product'=>$product]) </p>
      </div>

    </div>
    {{-- para que los botones de editar y eliminar aparescan si el usuario es el creador  --}}
    @if(Auth::check() && $product->id_usuario == Auth::user()->id)
      <div class="actions">
        <div class="row right-text">
          <div class="col-sm-1 col-xs-3 ">
            <a class="btn btn-warning btn-sm" href="{{ url('products/'.$product->id.'/edit') }}">Editar</a>
          </div>
          <div class="col-sm-1 col-xs-3">
            @include('products.delete',['product'=>$product])
          </div>
        </div>
      </div>
    @endif()
  </div>
</div>
@endsection
