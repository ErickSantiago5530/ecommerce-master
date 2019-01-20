<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = ['status'];// todas la variables que esten en esta sesion no podran ser modificadas

    //
    public function approve(){
      $this->updateCustomIDandStatus();
    }

    public function generateCustomID(){
      return md5("$this->id $this->updated_at");
    }

    public function updateCustomIDandStatus(){
      $this->status = "approved";
      $this->customid = $this->generateCustomID();
      $this->save();
    }

    public function inShoppingCarts(){
        return $this->hasMany("App\InShoppingCart");
    }

    public function order(){
      return $this->hasOne("App\Order")->first();
    }

    public function products(){
      return $this->belongsToMany('App\Product','in_shopping_carts');
    }

    public function productsSize(){
      // return $this->id;
      // return 3;
      return $this->products()->count();
    }

    public function total(){
      return $this->products()->sum("precio");
    }

    public function totalUSD(){
      return $this->products()->sum("precio")/100;
    }

    public static function findOrCreateBySessionID($shopping_cart_id){
      // var_dump(ShoppingCart::createWhithoutSession($shopping_cart_id));die();
      if ($shopping_cart_id>=1) {
        // buscar carrito de compras con este id
        return ShoppingCart::findBySession($shopping_cart_id);
      }else{
        //crear un carrito de compras
        return ShoppingCart::createWhithoutSession($shopping_cart_id);
      }
    }

    public static function findBySession($shopping_cart_id){
      return ShoppingCart::find($shopping_cart_id);
    }

    public static function createWhithoutSession(){
      return ShoppingCart::create(['status'=>'incompleted']);
    }
}
