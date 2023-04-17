<?php
namespace Boringue\Backend\http\middlewares;

use Boringue\Backend\http\middlewares\contract\DataVerificationInterface;
use Exception;

class DataVerification implements DataVerificationInterface{
  
    public function ValueLenght($value, int $lenght)
    {
        if(strlen($value) < $lenght){
            return true;
        }

        throw new Exception($value . " too long");
    }

    public function EmptyValues(array $data)
    {
        foreach($data as $d => $value){
            if(empty($value)){
                throw new Exception($d." is empty");
            }
        }

        return true;
    }
}