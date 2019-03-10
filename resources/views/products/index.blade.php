@extends('layouts.app')

@section('content')

<div class="big-padding text-center blue-grey white-text">
  <h1>Productos</h1>
</div>
<div class="container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <td>ID</td>
        <td>Titulo</td>
        <td>Descripcion</td>
        <td>Precio</td>
        <td>Acciones</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr>
          <td> {{ $product->id }}</td>
          <td> {{ $product->titulo }}</td>
          <td> {{ $product->descripcion }}</td>
          <td> {{ $product->precio }}</td>
          <td>
            <div class="row">
              <div class="col-sm-2 col-xs-3">
                <a class="btn btn-primary btn-xs" href="{{ url('products/'.$product->id) }}"><i class="fas fa-eye"></i></a>
              </div>
              <div class="col-sm-2 col-xs-3">
                <a class="btn btn-warning btn-xs" href="{{ url('products/'.$product->id.'/edit') }}"><i class="fas fa-edit"></i></a>
              </div>
              <div class="col-sm-2 col-xs-3">
                @include('products.delete',['product'=>$product])
              </div>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="floating">
  <a href="{{ url('/products/create') }}" class="btn btn-primary btn-fab">
    <!-- <i class="material-icons">Agregar</i> -->
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar
  </a>
</div>
@endsection
