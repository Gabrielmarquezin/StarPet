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
                'photo' => $user->getPhoto()
            ];
          
            $sql = "INSERT INTO users (nome, email, photo) VALUES (:nome, :email, :photo)";
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
            $data = ['email' => $user->getEmail()];

            $sql = "SELECT * FROM users WHERE email = :email";
            $query = $db->prepare($sql);
            
            $query->execute($data);
            
            return $query->rowCount();

        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

