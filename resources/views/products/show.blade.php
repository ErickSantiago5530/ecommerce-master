@extends('layouts.app')

@section('content')
  <div class="container">
    @include("products.product",["product"=>$product])
  </div>
@endsection
