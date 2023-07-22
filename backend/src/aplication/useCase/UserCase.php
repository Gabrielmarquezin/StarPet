<?php
namespace Boringue\Backend\aplication\useCase;

use Boringue\Backend\aplication\repositories\UserRepository;
use Boringue\Backend\aplication\useCase\contract\UserCaseInterface;
use Boringue\Backend\domain\entities\UserEntity;
use Boringue\Backend\file\RenderFile;
use Exception;
use React\Dns\Query\RetryExecutor;

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

        $cont = $UserRepository->findUserByEmail($UserEntity);

        if(count($cont) == 0){
            $cod_user = $UserRepository->addUser($UserEntity);

            return  ["cod_user" => $cod_user, "message" => "user cadastrado"];
        }
        
        return ["cod_user" => $cont[0]["cod"], "message" => "user ja esta cadastrado"];
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

    public function find(UserEntity $userEntity, UserRepository $userRepository, $cod){
        if($cod == 0){
            $users = $userRepository->findAll($userEntity);
            
            return $users;
        }else{
            $userEntity->setId($cod);

            $user = $userRepository->findUser($userEntity);

            return $user;
        }
    }

    public function findAdm(UserEntity $userEntity, UserRepository $userRepository)
    {
        $dados = $this->dados;
        $userEntity->setEmail($dados['email'])
                   ->setSenha($dados['senha']);

        try{
            $data = $userRepository->findAdm($userEntity);

            if(empty($data)){
                throw new Exception("nenhum adm");
            }

            return $data;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
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
                    ->setCasaN($dados['casa_numero'])
                    ->setId($dados['cod_user']);

        try{
            $response = $userRepository->update($userEntity);
            return $response;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}