<?php
namespace Boringue\Backend\http\middlewares\contract;

interface DataVerificationInterface{
    public function ValueLenght($value, int $lenght);
    public function EmptyValues(array $data);
}