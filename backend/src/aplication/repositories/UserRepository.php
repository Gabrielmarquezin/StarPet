<?php
namespace Boringue\Backend\aplication\repositories;

use Boringue\Backend\aplication\repositories\contract\UserRepositoryInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\UserEntity;
use Exception;
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

            return $db->lastInsertId();
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function addUserAdm(UserEntity $user)
    {
        $cnt = $this->ctn;
        $data = [
            'nome' => $user->getNome(),
            'email' => $user->getEmail(),
            'photo' => $user->getPhoto(),
            'rua' => $user->getRua(),
            'bairro' => $user->getBairro(),
            'casa' => $user->getCasaN(),
            "senha" => $user->getSenha()
        ];

        try{
            $sql = "INSERT INTO users (nome, email, photo, rua, bairro, casa, senha) VALUES (:nome, :email, :photo, :rua, :bairro, :casa, :senha)";
            $query = $cnt->prepare($sql);
            $query->execute($data);

            return $cnt->lastInsertId();
        }catch(Exception $e){
            if($e->getCode() == "23000"){
                throw new Exception("password incorect");
            }
            throw new Exception($e->getMessage());
        }
    }

    public function findUser(UserEntity $user)
    {
        try {
            $db = $this->ctn;
            $userData = ['cod' => $user->getId()];

            $sql = "SELECT * FROM users WHERE cod = :cod";
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

                if (ctype_xdigit(bin2hex($user->getPhoto()))) {
                    // o campo é binário
                    $base64Image = base64_encode($user->getPhoto());
                    $user->setPhoto($base64Image);
                }

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
                
                if (ctype_xdigit(bin2hex($user->getPhoto()))) {
                    // o campo é binário
                    $base64Image = base64_encode($user->getPhoto());
                    $user->setPhoto($base64Image);
                }

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

    public function findAdm(UserEntity $user)
    {
        $cnt = $this->ctn;
        $email = $user->getEmail();
        $senha = $user->getSenha();
        try{
            $sql = "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'";
            $query = $cnt->prepare($sql);
            $query->execute();

            $data_fetch = $query->fetchAll();

            if(empty($data_fetch)){
                return $data_fetch;
            }

            $dados = [];
            foreach($data_fetch as $a){
                $user->setId(strval($a['cod']))
                     ->setNome($a['nome'])
                     ->setEmail($a['email'])
                     ->setPhoto($a['photo'])
                     ->setRua(strval($a['rua']))
                     ->setBairro(strval($a['bairro']))
                     ->setCasaN(strval($a['casa']))
                     ->setSenha($a['senha']);

                if (ctype_xdigit(bin2hex($user->getPhoto()))) {
                    // o campo é binário
                    $base64Image = base64_encode($user->getPhoto());
                    $user->setPhoto($base64Image);
                }

                $dados[] = [
                    "cod" => $user->getId(),
                    "nome" => $user->getNome(),
                    "email" => $user->getEmail(),
                    "photo" => $user->getPhoto(),
                    "rua" => $user->getRua(),
                    "bairro" => $user->getBairro(),
                    "casa" => $user->getCasaN(),
                    "senha" => $user->getSenha()
                ];

                return $dados;
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function update(UserEntity $user)
    {
        $cnt = $this->ctn;
        $data = [
            'photo' => $user->getPhoto(),
            'rua' => $user->getRua(),
            'bairro' => $user->getBairro(),
            'casa' => $user->getCasaN(),
            "cod" => (int) $user->getId()
        ];

        try{
            $sql = "UPDATE users SET photo = :photo, rua = :rua, bairro = :bairro, casa = :casa WHERE cod = :cod";
            $query = $cnt->prepare($sql);
            $query->execute($data);

            if(!$query->rowCount()){
                throw new Exception("User nao existe ou nao ha o que atualizar");
            }

            return $cnt->lastInsertId();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}

