@extends('layouts.app')
@section('title','Productos')

@section('content')
  <div class="container text-center products-container">
    <div class="row">
      @foreach($products as $product)
        <div class="col-xs-10 col-sm-6 col-lg-6">
          @include("products.product",["product"=>$product])
        </div>
      @endforeach
      <div>
        {{ $products->links() }}
      </div>
    </div>
  </div>
@endsection
