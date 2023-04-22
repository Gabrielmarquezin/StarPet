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

    public function add(AdocaoEntity $adocao)
    {
        $cnt = $this->db;
        $dados = [
            "cod_user" => $adocao->getCodUser(),
            "cod_pet" => $adocao->getCodProduto(),
            "email" => $adocao->getEmail(),
            "cpf" => $adocao->getCPF(),
            "rua" => $adocao->getRua(),
            "bairro" => $adocao->getBairro(),
            "telefone" => $adocao->getTelefone(),
            "casa" => $adocao->getCasaN()
        ];

        try{
            $sql = "INSERT INTO adocao_pedido (cod_user, cod_pet, email, cpf, rua, bairro, telefone, casa)
            VALUES (:cod_user, :cod_pet, :email, :cpf, :rua, :bairro, :telefone, :casa)";

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
        
    }

    public function findByPet(AdocaoEntity $adocao)
    {
        $cnt = $this->db;
        $cod_pet = $adocao->getCodProduto();
        try{
            $sql = "SELECT a.*, users.photo as user_photo, users.nome as user_nome, pet.photo as photo_pet, pet.descricao as pet_descricao, pet.nome as pet_nome FROM adocao_pedido as a 
            INNER JOIN pet 
            ON a.cod_pet = '$cod_pet'
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
                $adocao->setCodProduto($p['cod_pet'])
                       ->setCodUser($p['cod_user'])
                       ->setEmail($p['email'])
                       ->setCPF($p['cpf'])
                       ->setRua($p['rua'])
                       ->setBairro($p['bairro'])
                       ->setCasaN($p['casa'])
                       ->setTelefone($p['telefone'])
                       ->setDataAdocao($p['data_pedido']);

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
                        "nome" => $p['pet_nome']
                    ]
                ];
            }

            return $nota_pedido;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findByCategoriaProduto(CategoriaEntity $categoria, UserEntity $user)
    {
        
    }

    public function findAll()
    {
        
    }
}