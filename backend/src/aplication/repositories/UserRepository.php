<?php
namespace Boringue\Backend\aplication\repositories;

use Boringue\Backend\aplication\repositories\contract\UserRepositoryInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\UserEntity;
use PDOException;

class UserRepository implements UserRepositoryInterface{
    private $ctn;

    public function __construct(Database $ctn)
    {
        $this->ctn = $ctn::conexao();
    }

    public function addUser(UserEntity $user)
    {
        try{
            $db = $this->ctn;
            $data = [
                'nome' => $user->getNome(),
                'email' => $user->getEmail(),
                'photo' => $user->getPhoto(),
                'rua' => $user->getRua(),
                'bairro' => $user->getBairro(),
                'casa' => $user->getCasaN()
            ];
          
            $sql = "INSERT INTO users (nome, email, photo, rua, bairro, casa) VALUES (:nome, :email, :photo, :rua, :bairro, :casa)";
            $query = $db->prepare($sql);
            $query->execute($data);

        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function findUser(UserEntity $user)
    {
        try {
            $db = $this->ctn;
            $userData = ['email' => $user->getEmail()];

            $sql = "SELECT * FROM users WHERE email = :email";
            $query = $db->prepare($sql);
            
            $query->execute($userData);
            $data = $query->fetchAll();

            $usuario = [];

            foreach($data as $row){
                $user->setId(strval($row['cod']))
                     ->setNome($row['nome'])
                     ->setEmail($row['email'])
                     ->setPhoto($row['photo'])
                     ->setRua(strval($row['rua']))
                     ->setBairro(strval($row['bairro']))
                     ->setCasaN(strval($row['casa']));
                $usuario[] = [
                    "cod" => $user->getId(),
                    "nome" => $user->getNome(),
                    "email" => $user->getEmail(),
                    "photo" => $user->getPhoto(),
                    "rua" => $user->getRua(),
                    "bairro" => $user->getBairro(),
                    "casa" => $user->getCasaN()
                ];
            };
            
            return $usuario;
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function findAll(UserEntity $user)
    {
        try {
            $db = $this->ctn;
            
            $sql = "SELECT * FROM users";
            $query = $db->prepare($sql);
            
            $query->execute();
            $data = $query->fetchAll();
            $users = [];

            foreach($data as $row){
                $user->setId(strval($row['cod']))
                     ->setNome($row['nome'])
                     ->setEmail($row['email'])
                     ->setPhoto($row['photo'])
                     ->setRua(strval($row['rua']))
                     ->setBairro(strval($row['bairro']))
                     ->setCasaN(strval($row['casa']));
                $users[] = [
                    "cod" => $user->getId(),
                    "nome" => $user->getNome(),
                    "email" => $user->getEmail(),
                    "photo" => $user->getPhoto(),
                    "rua" => $user->getRua(),
                    "bairro" => $user->getBairro(),
                    "casa" => $user->getCasaN()
                ];
            }

            return $users;
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

