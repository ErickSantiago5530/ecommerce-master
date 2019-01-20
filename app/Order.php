<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['recipient_name','line1','line2','city','country_code','state','postal_code','total','email','shopping_cart_id','status'];

    public function address(){
      return "$this->line1 $this->line2";
    }

    public static function createFromPayPalResponse($response,$shopping_cart){
      $payer = $response->payer;
      $orderData = (array)$payer->payer_info->shipping_address;
      $orderData = $orderData[key($orderData)];
      $orderData["email"] = $payer->payer_info->email;
      $orderData["shopping_cart_id"]=$shopping_cart->id;
      $orderData["total"] = $shopping_cart->total();

      return Order::create($orderData);
    }
}
