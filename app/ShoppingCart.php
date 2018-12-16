<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = ['status'];// todas la variables que esten en esta sesion no podran ser modificadas

    //
    public function productsSize(){
      return $this->id;
    }

    public static function findOrCreateBySessionID($shopping_cart_id){
      if ($shopping_cart_id) {
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
