<?php
namespace Boringue\Backend\domain\entities\payment;

use Boringue\Backend\domain\contract\payment\PixEntityInterface;

class Pix implements PixEntityInterface{
    private $payment;
    public static array $payer;

    public function __construct(){}

    public function setGateway($gatwey){
        $this->payment = $gatwey;
        $this->payment->payment_method_id = "pix";

        return $this;
    }

    public function setEmail(string $email)
    {
       self::$payer["email"] = $email;
       return $this;
    }

    public function setCPF(string $cpf)
    {
        self::$payer["identification"] = [
            "type" => "CPF",
            "number" => $cpf
        ];
        return $this;
    }

    public function setCEP(string $cep)
    {
        self::$payer["address"] = [
            "zip_code" => $cep
        ];
        return $this;
    }

    public function setBairro($bairro)
    {
        self::$payer["address"]["neighborhood"] = $bairro;
        return $this;
    }

    public function setRua($rua)
    {
        self::$payer["address"]["street_name"] = $rua;
        return $this;
    }

    public function setUF($uf)
    {
        self::$payer["address"]["federal_unit"] = $uf;
        return $this;
    }

    public function setCity($city)
    {
        self::$payer["address"]["city"] = $city;
        return $this;
    }

    public function setStreetNumber(string $number)
    {
        self::$payer["address"]["street_number"] = $number;
        return $this;
    }

    public function setFirstName($name)
    {
        self::$payer["first_name"] = $name;
        return $this;
    }

    public function setLastName($name)
    {
        self::$payer["last_name"] = $name;
        return $this;
    }

    public function getQrCode(){
        $this->payment->payer = self::$payer;
      
        if($this->payment->save()){
            $dados = [
                'qr_code_base64' => $this->payment->point_of_interaction->transaction_data->qr_code_base64,
                'qr_code' => $this->payment->point_of_interaction->transaction_data->qr_code,
                'payment_id' => $this->payment->id
            ]; 
        }else{
            echo "Error: " . $this->payment->error->message;
        }
    }
}