<?php

namespace App;

use URL;
use Config;

use PayPal\Core\PayPalHttpClient;
use PayPal\v1\Payments\PaymentCreateRequest;
use PayPal\v1\Payments\Payment\ExecuteRequest;
use PayPal\Core\SandboxEnvironment; //ProductionEnviroment for production calls.
use PayPal\v1\Payments\PaymentExecuteRequest;

class PayPal
{
    public $client, $enviroment;

    public function __construct()
    {
        $clientid = Config::get('services.paypal.clientid');
        $secret = Config::get('services.paypal.secret');

        $this->enviroment = new SandboxEnvironment($clientid, $secret);
        $this->client = new PayPalHttpClient($this->enviroment);
    }

    //Solicitud cobro
    public function buildPaymentRequest($amount)
    {
        $request =  new PaymentCreateRequest();
        $body = [
            "intent" => "sale",
            "transactions" => [
                [
                    "amount" => ["total" => $amount, "currency" => "USD"]
                ]
            ],
            "payer" => [
                "payment_method" => "paypal",
            ],
            "redirect_urls" => [
                "cancel_url" => URL::route('shopping_cart.show'),
                "return_url" => URL::route('payments.execute')
            ]
        ];
        $request->body = $body;
        return $request;
    }

    //Ejecución cobro
    public function charge($amount)
    {
       return  $this->client->execute($this->buildPaymentRequest($amount));
    }

    public function execute($paymentId,$payerId){
        $paymentExecute = new PaymentExecuteRequest($paymentId);
        $paymentExecute->body = [
            "payer_id" => $payerId
        ];
        return $this->client->execute($paymentExecute);
    }
}
