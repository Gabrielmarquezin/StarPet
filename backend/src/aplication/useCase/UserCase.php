<?php
namespace Boringue\Backend\aplication\useCase;

use Boringue\Backend\aplication\repositories\UserRepository;
use Boringue\Backend\aplication\useCase\contract\UserCaseInterface;
use Boringue\Backend\domain\entities\UserEntity;
use Boringue\Backend\file\RenderFile;
use Exception;

class UserCase implements UserCaseInterface{
    private $dados = [];

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function add(UserEntity $UserEntity ,UserRepository $UserRepository){
        $dados = $this->dados;

        // Verifica se o arquivo foi enviado com sucesso
        if(!empty($dados['photo'])) {
            $arquivo = $dados['photo'];
            $file = new RenderFile($arquivo);
            $dados['photo'] = $file->Render();            
        }

        
        $UserEntity->setNome($dados['nome'])
             ->setEmail($dados['email'])
             ->setPhoto($dados['photo'])
             ->setBairro($dados['bairro'])
             ->setRua($dados['rua'])
             ->setCasaN($dados['casa_numero']);

        $cont = $UserRepository->findUser($UserEntity);

        if(count($cont) == 0){
            $UserRepository->addUser($UserEntity);

            return "user create";
        }
        
        throw new Exception("user have been exist");
    }

    public function addAdm(UserEntity $userEntity, UserRepository $UserRepository)
    {
        $dados = $this->dados;

        if(!empty($dados['photo'])) {
            $arquivo = $dados['photo'];
            $file = new RenderFile($arquivo);
            $dados['photo'] = $file->Render();            
        }

        $userEntity->setNome($dados['nome'])
                    ->setEmail($dados['email'])
                    ->setPhoto($dados['photo'])
                    ->setBairro($dados['bairro'])
                    ->setRua($dados['rua'])
                    ->setCasaN($dados['casa_numero'])
                    ->setSenha($dados['senha']);
        try{
            $adm = $UserRepository->findAdm($userEntity);
            if(empty($adm)){
               return $UserRepository->addUserAdm($userEntity);
            }else{
                throw new Exception("ADM ja existe");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
        
    }

    public function find(UserEntity $userEntity, UserRepository $userRepository, $email){
        if($email == 0){
            $users = $userRepository->findAll($userEntity);
            
            return $users;
        }else{
            $userEntity->setEmail($email);

            $user = $userRepository->findUser($userEntity);

            return $user;
        }
    }

    public function updateUser(UserEntity $userEntity, UserRepository $userRepository)
    {
        $dados = $this->dados;
        
        if(!empty($dados['photo'])) {
            $arquivo = $dados['photo'];
            $file = new RenderFile($arquivo);
            $dados['photo'] = $file->Render();            
        }

        $userEntity->setPhoto($dados['photo'])
                    ->setBairro($dados['bairro'])
                    ->setRua($dados['rua'])
                    ->setCasaN($dados['casa_number'])
                    ->setId($dados['cod_user']);

        try{
            $response = $userRepository->update($userEntity);
            return $response;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}