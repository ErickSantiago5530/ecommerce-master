{!! Form::open(['url'=>'products/'.$product->id,'method' => 'DELETE']) !!}
  <button type="submit" name="button" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></button>
{!! Form::close() !!}
