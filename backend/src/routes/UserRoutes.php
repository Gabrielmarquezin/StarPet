<?php
namespace Boringue\Backend\routes;

use Boringue\Backend\http\controller\UserController;
use Boringue\Backend\routes\framework\Router;

class UserRoutes{
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

        $route->post('/StarPet/backend/login', $controller->createUser());

        return $this;
    }


    public function Execute()
    {
        $result = $this->route->handler();

        if(!$result){
            http_response_code(404);
            die("does not GET");
        }

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

