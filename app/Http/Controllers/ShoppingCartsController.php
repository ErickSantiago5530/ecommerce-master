<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCart;
use App\PayPal;
use App\Order;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;

class ShoppingCartsController extends Controller
{
    public function __construct(){
        $this->middleware("shoppingcart");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $shopping_cart = $request->shopping_cart;
      // $shopping_cart_id = \Session::get('shopping_cart_id');
      // $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
      $order = Order::all()->last();
      // $order->sendUpdateMail();
      // $paypal = new PayPal($shopping_cart);
      // $payment = $paypal->generate();
      // return redirect($payment->getApprovalLink());

      $products = $shopping_cart->products()->get();
      $total = ($shopping_cart->total()==="0"||$shopping_cart->total()===0)?"0.00":$shopping_cart->total();
      // var_dump($total);die();
      return view("shopping_carts.index",["products"=>$products,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function checkout(Request $request){
      $shopping_cart = $request->shopping_cart;
      $paypal = new PayPal($shopping_cart);
      $payment = $paypal->generate();
      return redirect($payment->getApprovalLink());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shopping_cart = ShoppingCart::where('customid',$id)->first();
        $order = $shopping_cart->order();
        return view("shopping_carts.completed",["shopping_cart"=>$shopping_cart,"order"=>$order]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
