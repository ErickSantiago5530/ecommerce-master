
{!! Form::open(['url'=>$url,'method' => $method,'files'=>true]) !!}
<div class="form-group">
  {{ Form::text('titulo',$product->titulo,['class'=>'form-control','placeholder'=>'Titulo']) }}
</div>
<div class="form-group">
  {{ Form::number('precio',$product->precio,['class'=>'form-control','placeholder'=>'Precio de tu producto en centavos de dolar']) }}
</div>

<div class="form-group">
  {{ Form::file('cover') }}
</div>

<div class="form-group">
  {{ Form::textarea('descripcion',$product->descripcion,['class'=>'form-control','placeholder'=>'Descripcion']) }}
</div>
<div class="form-group text-right">
  <a href="{{ url('/products') }}">Regresar al listado de productos</a>
  <input type="submit" name="" value="Guardar" class="btn btn-success">
</div>
{!! Form::close() !!}
