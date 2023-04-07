<?php
namespace Boringue\Backend\http\controller\contract;

interface UserControllerInterface{
    public function createUser();
    public function getUser();
    public function updateUser();
}