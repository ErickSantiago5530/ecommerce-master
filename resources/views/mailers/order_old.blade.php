<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>!Hola que tal</h1>
    <p>Te enviamos los datos de tu compra realizada con exito!</p>

    <table>
      <thead>
        <tr>
          <th>Producto</th>
          <th>Costo</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td>{{ $product->titulo}}</td>
          <td>{{ $product->precio}}</td>
        </tr>
        @endforeach
        <tr>
          <td>Total</td>
          <td>{{$order->total}}</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
