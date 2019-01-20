<?php
namespace App;
use PaypalPayment;
/**
 *
 */
class PayPal{
  private $_apiContext;
  private $shopping_cart;
  private $_ClientId = "AR7v95N99OznP87SVpDgxj0fAbFXwaHXfXpAjOflGyle11kXVb_VbCgDcbvrR3S4MRXBnsBn8Lpl1ufz";
  private $_ClientSecret = "EORu8ehCrmdsRXnePhH9ceWoNO8ot5CicXwP_uY5n_4xwT4HDCtuY5qAwa6TzntzK-VNfHYqfL6OTvmL";

  function __construct($shopping_cart){
    // code...
    $this->_apiContext = \PaypalPayment::ApiContext($this->_ClientId,$this->_ClientSecret);
    $config = config('paypal_payment');
    $flatConfig = array_dot($config);
    $this->_apiContext->setConfig($flatConfig);
    $this->shopping_cart = $shopping_cart;
  }

  public function generate(){
    $payment = \PaypalPayment::payment()
                ->setIntent("sale")//cual es el objetivo de la petision -- sale = vender
                ->setPayer($this->payer())//se manda el tipo de pago en este caso paypal
                ->setTransactions([$this->transaction()])//son los articulos que queremos cobrar -- se le pasa un arreglo
                ->setRedirectUrls($this->redirectURLs());//las urls de redireccionamiento

    try {
      $payment->create($this->_apiContext);
    }catch (\Exception $e) {
      dd($e);
      exit(1);
    }
    return $payment;
  }

  public function payer(){
    return \PaypalPayment::payer()->setPaymentMethod("paypal");//tipo de cobro en este caso sera por paypal
  }

  public function redirectURLs(){
    $baseURL = url('/');
    return \PaypalPayment::redirectUrls()
            ->setReturnUrl("$baseURL/payments/store")
            ->setCancelUrl("$baseURL/carrito");
  }

  public function transaction(){
    return \PaypalPayment::transaction()
            ->setAmount($this->amount())
            ->setItemList($this->items())
            ->setDescription("Tu compra realizada con Exito")
            ->setInvoiceNumber(uniqid());
  }

  public function items(){
    $items = [];
    $products = $this->shopping_cart->products()->get();
    foreach ($products as $product ) {
      array_push($items,$product->paypalItem($product));
    }
    return \PaypalPayment::itemList()->setItems($items);
  }

  public function amount(){
    return \PaypalPayment::amount()
            ->setCurrency("USD")//le asignamos el valor en que queremos cobrar
            ->setTotal($this->shopping_cart->totalUSD());
            // ->setTotal($this->shopping_cart->total());
  }

  public function execute($paymentId,$payerId){
    $payment = \PaypalPayment::getById($paymentId,$this->_apiContext);
    $execution = \PaypalPayment::PaymentExecution()->setPayerId($payerId);

    return $payment->execute($execution,$this->_apiContext);
  }

}

?>
