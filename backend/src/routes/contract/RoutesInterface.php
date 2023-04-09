<?php
namespace Boringue\Backend\routes\contract;

Interface RoutesInterface{
    public function initRoutes();
    public function execute();
}