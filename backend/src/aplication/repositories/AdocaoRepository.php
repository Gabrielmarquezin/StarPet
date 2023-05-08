<?php
namespace Boringue\Backend\aplication\repositories;

use Boringue\Backend\aplication\repositories\contract\AdocaoRepositoryInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\AdocaoEntity;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\UserEntity;
use Exception;

class AdocaoRepository implements AdocaoRepositoryInterface{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db::conexao();    
    }

    private function AdotarPet($idpet){
        $cnt = $this->db;
        try{
            $sql = "UPDATE pet_adocao SET adotado = 1 WHERE cod = '$idpet'";
            $query = $cnt->prepare($sql);
            $query->execute();

            if(!$query->rowCount()){
                throw new Exception("pet inexistente");
            }

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function add(AdocaoEntity $adocao)
    {
        $cnt = $this->db;
        $dados = [
            "cod_user" => $adocao->getCodUser(),
            "cod_pet_adocao" => $adocao->getCodProduto(),
            "email" => $adocao->getEmail(),
            "cpf" => $adocao->getCPF(),
            "rua" => $adocao->getRua(),
            "bairro" => $adocao->getBairro(),
            "telefone" => $adocao->getTelefone(),
            "casa" => $adocao->getCasaN()
        ];

        try{
            $this->AdotarPet($dados['cod_pet_adocao']);

            $sql = "INSERT INTO adocao_pedido (cod_user, cod_pet_adocao, email, cpf, rua, bairro, telefone, casa)
            VALUES (:cod_user, :cod_pet_adocao, :email, :cpf, :rua, :bairro, :telefone, :casa)";

            $query = $cnt->prepare($sql);
            $query->execute($dados);

            $id = $cnt->lastInsertId();

            return $id;
        }catch(Exception $e){
            throw new Exception($e->getMessage());     
        }
    }

    public function find(AdocaoEntity $adocao)
    {
        $cnt = $this->db;
        $cod_pet = $adocao->getCodProduto();
        $cod_user = $adocao->getCodUser();

        try{
            $sql = "SELECT DISTINCT a.*, users.photo as user_photo, users.nome as user_nome, pet.adotado, pet.photo as photo_pet, pet.descricao as pet_descricao, pet.nome as pet_nome FROM adocao_pedido as a
            INNER JOIN pet_adocao as pet
            ON a.cod_pet_adocao = '$cod_pet'
            AND pet.cod = a.cod_pet_adocao
            INNER JOIN users
            ON users.cod = '$cod_user'";

            $query = $cnt->prepare($sql);
            $query->execute();

            $dados = $query->fetchAll();
            if(empty($dados)){
                return $dados;
            }

            $pedido = [];
            foreach($dados as $p){
                $adocao->setCodProduto($p['cod_pet_adocao'])
                       ->setCodUser($p['cod_user'])
                       ->setEmail($p['email'])
                       ->setCPF($p['cpf'])
                       ->setRua($p['rua'])
                       ->setBairro($p['bairro'])
                       ->setCasaN($p['casa'])
                       ->setTelefone($p['telefone'])
                       ->setDataAdocao($p['data_pedido']);

                if (ctype_xdigit(bin2hex($p["user_photo"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["user_photo"]);
                    $p["user_photo"] = $base64Image;
                }

                if (ctype_xdigit(bin2hex($p["photo_pet"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo_pet"]);
                    $p["photo_pet"] = $base64Image;
                }

                $pedido[] = [
                    "cod_user" => $adocao->getCodUser(),
                    "photo_user" => $p['user_photo'],
                    "nome_user" => $p['user_nome'],
                    "email" => $adocao->getEmail(),
                    "cpf" => $adocao->getCPF(),
                    "rua" => $adocao->getRua(),
                    "bairro" => $adocao->getBairro(),
                    "telefone" => $adocao->getTelefone(),
                    "casa_numero" => $adocao->getCasaN(),
                    "data_adocao" => $adocao->getDataAdocao(),
                    "pet" => [
                        "cod" => $adocao->getCodProduto(),
                        "photo" => $p['photo_pet'],
                        "descricao" => $p['pet_descricao'],
                        "nome" => $p['pet_nome'],
                        "adotado" => $p['adotado']
                    ]
                ];
            }

            return $pedido;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findByPet(AdocaoEntity $adocao)
    {
        $cnt = $this->db;
        $cod_pet = $adocao->getCodProduto();
        try{
            $sql = "SELECT DISTINCT a.*, users.photo as user_photo, users.nome as user_nome, pet.adotado, pet.photo as photo_pet, pet.descricao as pet_descricao, pet.nome as pet_nome FROM adocao_pedido as a 
            INNER JOIN pet_adocao as pet
            ON pet.cod = '$cod_pet'
            AND pet.cod = a.cod_pet_adocao
            INNER JOIN users
            ON a.cod_user = users.cod";

            $query = $cnt->prepare($sql);
            $query->execute();

            $datas = $query->fetchAll();

            if(empty($datas)){
                return $datas;
            }

            $nota_pedido = [];

            foreach($datas as $p){
                $adocao->setCodProduto($p['cod_pet_adocao'])
                       ->setCodUser($p['cod_user'])
                       ->setEmail($p['email'])
                       ->setCPF($p['cpf'])
                       ->setRua($p['rua'])
                       ->setBairro($p['bairro'])
                       ->setCasaN($p['casa'])
                       ->setTelefone($p['telefone'])
                       ->setDataAdocao($p['data_pedido']);

                if (ctype_xdigit(bin2hex($p["user_photo"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["user_photo"]);
                    $p["user_photo"] = $base64Image;
                }

                if (ctype_xdigit(bin2hex($p["photo_pet"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo_pet"]);
                    $p["photo_pet"] = $base64Image;
                }

                $nota_pedido[] = [
                    "cod_user" => $adocao->getCodUser(),
                    "photo_user" => $p['user_photo'],
                    "nome_user" => $p['user_nome'],
                    "email" => $adocao->getEmail(),
                    "cpf" => $adocao->getCPF(),
                    "rua" => $adocao->getRua(),
                    "bairro" => $adocao->getBairro(),
                    "telefone" => $adocao->getTelefone(),
                    "casa_numero" => $adocao->getCasaN(),
                    "data_adocao" => $adocao->getDataAdocao(),
                    "pet" => [
                        "cod" => $adocao->getCodProduto(),
                        "photo" => $p['photo_pet'],
                        "descricao" => $p['pet_descricao'],
                        "nome" => $p['pet_nome'],
                        "adotado" => $p['adotado']
                    ]
                ];
            }

            return $nota_pedido;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findByCategoriaProduto(CategoriaEntity $categoria, AdocaoEntity $adocao)
    {
        $cnt = $this->db;
        $categoria = $categoria->getCategoriaName();

        try{
            $sql = "SELECT a.*, users.photo as user_photo, users.nome as user_nome, pet.adotado, pet.photo as photo_pet, pet.descricao as pet_descricao, pet.nome as pet_nome, c.nome_categoria FROM adocao_pedido as a 
            INNER JOIN pet_adocao as pet
            ON a.cod_pet_adocao = pet.cod
            INNER JOIN users
            ON a.cod_user = users.cod
            INNER JOIN produto_categoria as c
            ON pet.cod_categoria = c.cod
            WHERE c.nome_categoria = '$categoria'";

            $query = $cnt->prepare($sql);
            $query->execute();

            $dados = $query->fetchAll();
            if(empty($dados)){
                return $dados;
            }

            $pedidos = [];
            foreach($dados as $p){
                 $adocao->setCodProduto($p['cod_pet_adocao'])
                       ->setCodUser($p['cod_user'])
                       ->setEmail($p['email'])
                       ->setCPF($p['cpf'])
                       ->setRua($p['rua'])
                       ->setBairro($p['bairro'])
                       ->setCasaN($p['casa'])
                       ->setTelefone($p['telefone'])
                       ->setDataAdocao($p['data_pedido']);

                if (ctype_xdigit(bin2hex($p["user_photo"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["user_photo"]);
                    $p["user_photo"] = $base64Image;
                }

                if (ctype_xdigit(bin2hex($p["photo_pet"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo_pet"]);
                    $p["photo_pet"] = $base64Image;
                }

                $pedidos[] = [
                    "cod_user" => $adocao->getCodUser(),
                    "photo_user" => $p['user_photo'],
                    "nome_user" => $p['user_nome'],
                    "email" => $adocao->getEmail(),
                    "cpf" => $adocao->getCPF(),
                    "rua" => $adocao->getRua(),
                    "bairro" => $adocao->getBairro(),
                    "telefone" => $adocao->getTelefone(),
                    "casa_numero" => $adocao->getCasaN(),
                    "data_adocao" => $adocao->getDataAdocao(),
                    "pet" => [
                        "cod" => $adocao->getCodProduto(),
                        "photo" => $p['photo_pet'],
                        "descricao" => $p['pet_descricao'],
                        "nome" => $p['pet_nome'],
                        "adotado" => $p['adotado'],
                        "categoria" => $p['nome_categoria']
                    ]
                ];
            }

            return $pedidos;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findAll()
    {
        $cnt = $this->db;
        try{
            $sql = "SELECT a.*, users.photo as user_photo, users.nome as user_nome, pet.adotado, pet.photo as photo_pet, pet.descricao as pet_descricao, pet.nome as pet_nome FROM adocao_pedido as a 
            INNER JOIN pet_adocao as pet
            ON a.cod_pet_adocao = pet.cod
            INNER JOIN users
            ON a.cod_user = users.cod";

            $query = $cnt->prepare($sql);
            $query->execute();

            $dados = $query->fetchAll();
            if(empty($dados)){
                return $dados;
            }

            $pedidos = [];
            foreach($dados as $p){
                if (ctype_xdigit(bin2hex($p["user_photo"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["user_photo"]);
                    $p["user_photo"] = $base64Image;
                }

                if (ctype_xdigit(bin2hex($p["photo_pet"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo_pet"]);
                    $p["photo_pet"] = $base64Image;
                }

                $pedidos[] = [
                    "cod_user" => $p['cod_user'],
                    "photo_user" => $p['user_photo'],
                    "nome_user" => $p['user_nome'],
                    "email" => $p['email'],
                    "cpf" => $p['cpf'],
                    "rua" => $p['rua'],
                    "bairro" => $p['bairro'],
                    "telefone" => $p['telefone'],
                    "casa_numero" => $p['casa'],
                    "data_adocao" => $p['data_pedido'],
                    "pet" => [
                        "cod" => $p['cod_pet_adocao'],
                        "photo" => $p['photo_pet'],
                        "descricao" => $p['pet_descricao'],
                        "nome" => $p['pet_nome'],
                        "adotado" => $p['adotado']
                    ]
                ];
            }

            return $pedidos;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

}