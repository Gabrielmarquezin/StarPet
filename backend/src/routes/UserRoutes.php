<?php
namespace Boringue\Backend\routes;

use Boringue\Backend\http\controller\UserController;
use Boringue\Backend\routes\contract\RoutesInterface;
use Boringue\Backend\routes\framework\Router;

class UserRoutes implements RoutesInterface{
    private $route;
    private $UserController;

    public function __construct(Router $route, UserController $userController)
    {
        $this->route = $route;
        $this->UserController = $userController;
    }

    public function initRoutes()
    {
        $route = $this->route;
        $controller = $this->UserController;

        $route->post('/StarPet/backend/login', [$controller, "createUser"]);
        $route->get('/StarPet/backend/users', [$controller, "getUser"]);

        return $this;
    }


    public function execute()
    {
        $result = $this->route->handler();

        if(!$result){
            return;
        }

        $data = $result->getData(); 
        
        call_user_func(array($data['action'][0], $data['action'][1]));
    }

    private function middlewareBefore(){
        $result = $this->route->handler();

        $data = $result->getData(); 

        foreach ($data['before'] as $before) {
            // rodo o middleware
            if (!$before($this->route->getParams())) {
                // se retornar false eu paro a execução do código
                die();
            }

            if ($data['action']) {
                echo $data['action']($this->route->getParams());
            }
        }
    }

}

