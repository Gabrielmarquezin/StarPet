<?php
namespace Boringue\Backend\domain\entities\payment;

use Boringue\Backend\domain\contract\payment\CreditCardEntityInterface;
use Boringue\Backend\domain\contract\payment\MethodPaymentInterface;

class CreditCardEntity implements CreditCardEntityInterface{
    private array $dados;
    private $token;
    private $url;
  
    public function __construct($type)
    {
        $this->dados["charges"][]["payment_method"] = [
             "type" => $type,
             "capture" => true,
             "soft_descriptor" => "Starpet",
        ];
    }

    public function setCostumer(array $costumer)
    {
        $this->dados["costumer"] = $costumer;
    }
    
    public function setShipping(array $adress)
    {
        $this->dados["shipping"]["address"] = $adress;
    }

    public function setNotification(string $url)
    {
        $this->dados["notification_urls"] = [$url];
    }

    public function setItemValues(array $item)
    {
        $this->dados[] = $item;
    }

    public function setCardNumber(string $number)
    {
        $this->dados["charges"][]["payment_method"]["card"] = [
            "number" => $number
        ];
    }

    public function setExpMonth(string $exp_month)
    {
        $this->dados["charges"][]["payment_method"]["card"] = [
            "exp_month" => $exp_month
        ];
    }

    public function setExpYear(string $exp_year)
    {
        $this->dados["charges"][]["payment_method"]["card"] = [
            "exp_year" => $exp_year
        ];
    }

    public function setCodeSecurity(string $secutity)
    {
        $this->dados["charges"][]["payment_method"]["card"] = [
            "security_code" => $secutity
        ];
    }

    public function setName(string $name_cartao)
    {
        $this->dados["charges"][]["payment_method"]["card"] = [
            "holder" => [
                "name" => $name_cartao
            ]
        ];
    }

    public function setDescription(string $description)
    {
        $this->dados["charges"][]["description"] = $description;
        $this->dados["charges"][]["reference_id"] = "123456789";
    }

    public function setInstallments(int $installments)
    {
        $this->dados["charges"][]["payment_method"]["installments"] = $installments;
        
    }

    private function setMethodAuth(){
        $this->dados["charges"][]["payment_method"]["authentication_method"] = [
            "type" => "THREEDS",
            "cavv" =>"BwABBylVaQAAAAFwllVpAAAAAAA=",
            "xid" => "BwABBylVaQAAAAFwllVpAAAAAAA=",
            "eci"=> "05",
            "version" => "2.1.0",
            "dstrans_id" => "DIR_SERVER_TID"
        ];
    }

    public function setToken($token){
        $this->token = $token;
        define("TOKEN", $this->token);
    }

    public function setUrl(string $url){
        $this->url = $url;
        define("URL", $this->url);
    }

    public function pay(){
        $this->setMethodAuth();

        $data = $this->dados;
        
        $curl = curl_init(URL);
        curl_setopt($curl,CURLOPT_POST,true);
        curl_setopt($curl,CURLOPT_HTTPHEADER,array(
            'Authorization:'.TOKEN,
            'Content-Type: application/json'
        ));
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        $ress = curl_exec($curl);

        return $ress;
    }
}