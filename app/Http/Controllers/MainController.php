<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
// use App\Http\Request;

class MainController extends Controller{

    public function home(){
      $products = Product::latest()->simplePaginate(6);
      return view('main.home',["products"=>$products]);
    }
}
