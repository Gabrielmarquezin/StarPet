<?php
namespace Boringue\Backend\routes;

use Boringue\Backend\http\controller\UserController;
use Boringue\Backend\http\middlewares\DataVerification;
use Boringue\Backend\routes\contract\RoutesInterface;
use Boringue\Backend\routes\framework\Router;
use Exception;

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

        $route->post('/StarPet/backend/adm/login', [$controller, "createADM"])
        ->before(function(){
            $body = file_get_contents('php://input');
            $dados = json_decode($body, true);
            $user_data = [
                "email" => !isset($dados['email']) ? null : $dados['email']
            ];

            $middleware = new DataVerification();
            try{
                $middleware->EmptyValues($user_data);
                return true;
            }catch(Exception $e){
                echo json_encode(["message" => $e->getMessage()]);
                http_response_code(400);
                return false;
            }
          });

        $route->get('/StarPet/backend/users', [$controller, "getUser"]);

        $route->put('/StarPet/backend/users/update', [$controller, "updateUser"]);

        $route->put('/StarPet/backend/users/adm/update', [$controller, "updateUser"]);

        return $this;
    }


    public function execute()
    {
        $result = $this->route->handler();

        if(!$result){    
            return;
        }

        $data = $result->getData(); 

        if(empty($data['before'])){
            call_user_func(array($data['action'][0], $data['action'][1]));
            return;
        }

        $this->middlewareBefore();
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

