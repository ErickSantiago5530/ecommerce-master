<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCart;
use App\PayPal;
use App\Order;

class PaymentsController extends Controller
{
    //
    public function store(Request $request){

      /*Vamos a obtener de vuelta nuestro carrito de compras*/
      $shopping_cart_id = \Session::get('shopping_cart_id');
      $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

      /*Instanciamos Paypal por que va a ser el encargado de ejecutar el cobro*/
      $paypal = new PayPal($shopping_cart);

      $res = $paypal->execute($request->paymentId,$request->PayerID);
      if ($res->state === "approved") {

        \Session::remove("shopping_cart_id");
        $order = Order::createFromPayPalResponse($res,$shopping_cart);
        $shopping_cart->approve();
      }
      return view("shopping_carts.completed",["shopping_cart"=>$shopping_cart,"order"=>$order]);
    }
}
