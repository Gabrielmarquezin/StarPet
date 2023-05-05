<?php
namespace Boringue\Backend\http\teste;

require_once "../../../vendor/autoload.php";
require_once "../../../global.php";
include "../../config/gatewayPayment.php";


\MercadoPago\SDK::setAccessToken(TOKEN);

 $payment = new \MercadoPago\Payment();

 $payment->transaction_amount = 0.10;
 $payment->description = "Produto bom";
 $payment->payment_method_id = "pix";
 $payment->notification_url = "https://71a9-170-84-141-89.ngrok-free.app/StarPet/backend/src/webhook/notification.php";

 $payment->payer = array(
     "email" => "gabrielmarquesaraujo22@gmail.com",
     "first_name" => "Gabriel",
     "last_name" => "Araujo",
     "identification" => array(
         "type" => "CPF",
         "number" => "42212462867"
     ),
     "address" => array(
         "zip_code" => "62600000",
         "street_name" => "rua ferreira jardim",
         "street_number" => "61",
         "neighborhood" => "padre lima",
         "city" => "itapage",
         "federal_unit" => "CE"
     )
 );

 if ($payment->save()) {
     $dados = [
         'qr_code_base64' => $payment->point_of_interaction->transaction_data->qr_code_base64,
         'qr_code' => $payment->point_of_interaction->transaction_data->qr_code,
         'payment_id' => $payment->id
       ];
       $a = $dados['qr_code_base64'];
       echo "<img src=data:image/jpeg;base64,$a style='width: 350px; height:350px'/>";
 } else {
     echo "Error: " . $payment->error->message;
     var_dump($payment->error);
 }



// $b = $payment->point_of_interaction;
//  $c = $b->application_data;



 