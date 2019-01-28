<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;
use App\Mail\OrderUpdated;

class Order extends Model
{
    //
    protected $fillable = ['recipient_name','line1','line2','city','country_code','state','postal_code','total','email','shopping_cart_id','status'];

    public function sendMail(){
      Mail::to("santossantiagoerick@gmail.com")->send(new OrderCreated($this));

    }

    public function sendUpdateMail(){
      Mail::to("santossantiagoerick@gmail.com")->send(new OrderUpdated($this));
    }

    public function shoppingCartID(){
      return $this->shopping_cart()->customid;
    }

    public function scopeLatest($query){
      return $query->orderID()->monthly();
    }

    public function scopeOrderID($query){
      return $query->orderBy("id","desc");
    }

    public function scopeMonthly($query){
      return $query->whereMonth("created_at","=",date("m"));
    }

    public static function totalMonth(){
      return Order::monthly()->sum("total"); //total del mes
    }

    public static function totalMonthCount(){
      return Order::monthly()->count(); //total del mes
    }

    public function shopping_cart(){
      return $this->belongsTo('App\ShoppingCart');
    }

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
