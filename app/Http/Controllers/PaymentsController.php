<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCart;
use App\PayPal;
use App\Order;

class PaymentsController extends Controller
{
    public function __construct(){
        $this->middleware("shoppingcart");
    }
    //
    public function store(Request $request){

      /*Vamos a obtener de vuelta nuestro carrito de compras*/
      $shopping_cart = $request->shopping_cart;

      /*Instanciamos Paypal por que va a ser el encargado de ejecutar el cobro*/
      $paypal = new PayPal($shopping_cart);

      $res = $paypal->execute($request->paymentId,$request->PayerID);
      if ($res->state === "approved") {

        \Session::remove("shopping_cart_id");
        $order = Order::createFromPayPalResponse($res,$shopping_cart);
        $shopping_cart->approve();
        $order->sendMail();
      }
      return view("shopping_carts.completed",["shopping_cart"=>$shopping_cart,"order"=>$order]);
    }
}
