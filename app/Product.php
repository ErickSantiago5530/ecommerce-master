<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    private function getproducto($id){

    }

    public function scopeLatest($query){
      return $query->orderBy("id","desc");
    }

    public function paypalItem($product){
      return \PaypalPayment::item()
              ->setName($product->titulo)
              ->setDescription($product->descripcion)
              ->setCurrency('USD')
              ->setQuantity(1)
              ->setPrice($product->precio/100);
    }
}
