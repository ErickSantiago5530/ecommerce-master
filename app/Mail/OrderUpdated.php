<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderUpdated extends Mailable
{

    use Queueable, SerializesModels;

    public $order;
    public $products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->products = $order->shopping_cart->products()->get();

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      // return $this->from("santossantiagoerick@gmail.com")->view('mailers.order_updated');
      return $this->from("santossantiagoerick@gmail.com")->view('mailers.envio');
    }
}
