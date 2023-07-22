<?php


require_once "../../vendor/autoload.php";
require_once "../../global.php";

use Boringue\Backend\config\Database;
use MercadoPago\Payer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
$email = $_SESSION["email_payer"];
echo $email;

$mail = new PHPMailer(true);
$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = getenv("EMAIL");                     //SMTP username
    $mail->Password   = getenv("PASSWORD_EMAIL");                               //SMTP password
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

MercadoPago\SDK::setAccessToken(getenv("TOKEN"));
$payment = MercadoPago\Payment::find_by_id("59595773126");

print_r($payment->payer);

if($payment->{'status'} == "approved"){

    $mail->setFrom('gabriel.araujo112@aluno.ce.gov.br');
    $mail->addAddress("gabrielmarquesaraujo22@gmail.com");

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "SEU PEDIDO FOI BEM SUCEDIDO";
    $mail->Body    = 'Obrigado por fazer essas compra, volte sempre a <b>StarPet</b>
    <br>
    <br>
    <img src="https://www.figma.com/file/fEgSuffvBCY3GAojPkLC8v/image/be502e8da3496361af79c55727e047cbd5f1658a?fuid=1112104013700919642" >
    <img src="cid:starpet" >';

    $mail->AltBody = 'Pedido finalizado';
    $mail->addEmbeddedImage(dirname(__FILE__) . '/StarPetLogo.png', 'starpet');

    $mail->send();
};