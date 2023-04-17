<?php
namespace Boringue\Backend\aplication\repositories;

use Boringue\Backend\aplication\repositories\contract\PetRepositoryInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaPetEntity;
use Boringue\Backend\domain\entities\PetEntity;
use Cake\Database\Query;
use Exception;

class PetRepository implements PetRepositoryInterface{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db::conexao();
    }

    public function add(PetEntity $pet)
    {
        $cnt = $this->db;
        $data = [
            "photo" => $pet->getPhoto(),
            "descricao" => $pet->getDesc(),
            "quantidade" => $pet->getEstoque(),
            "nome" => $pet->getNome(),
            "cod_categoria" => $pet->getCodCategoria(),
            "cod_fichapet" => $pet->getCodFihcaTec(),
            "preco" => $pet->getPreco(),
        ];

        try{
            $sql = "INSERT INTO pet (photo, descricao, quantidade, nome, cod_categoria, cod_fichapet, preco)
            VALUES (:photo, :descricao, :quantidade, :nome, :cod_categoria, :cod_fichapet, :preco)";

            $query = $cnt->prepare($sql);
            $query->execute($data);

            return $cnt->lastInsertId();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function addFichaPet(FichaPetEntity $ficha_pet)
    {
        $cnt = $this->db;
        $data = [
            "raca" => $ficha_pet->getRaca(),
            "alergias" => $ficha_pet->getAlergias(),
            "observacoes" => $ficha_pet->getObservacoes(),
            "tamanho" => $ficha_pet->getTamanho(),
            "estoque" => $ficha_pet->getEstoque()
        ];

        try{
            $sql = "INSERT INTO ficha_pet (raca, alergias, observacoes, tamanho, estoque) 
            VALUES (:raca, :alergias, :observacoes, :tamanho, :estoque)";

            $query = $cnt->prepare($sql);
            $query->execute($data);

            $cod = $cnt->lastInsertId();
            return $cod;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function find(PetEntity $pet)
    {
        $cnt = $this->db;
        $cod_pet = $pet->getCod();

        try{
            $sql = "SELECT p.cod AS cod_pet, p.photo, p.descricao, p.quantidade, p.nome, p.cod_fichapet, p.cod_categoria, p.preco, c.nome_categoria, f.raca, f.alergias, f.observacoes, f.tamanho, f.estoque
            FROM pet AS p INNER JOIN produto_categoria AS c
            ON p.cod_categoria = c.cod
            AND p.cod = '$cod_pet'
            INNER JOIN ficha_pet as f
            ON p.cod_fichapet = f.cod
            WHERE p.cod = '$cod_pet'";

            $query = $cnt->prepare($sql);
            $query->execute();

            $dados = $query->fetchAll();

            if(empty($dados)){
                throw new Exception("nenhum pet registrado");
            }

            $pets = [];

            foreach($dados as $p){
                $pet->setCod($p['cod_pet'])
                    ->setPhoto($p['photo'])
                    ->setDesc($p['descricao'])
                    ->setEstoque($p['quantidade'])
                    ->setNome($p['nome'])
                    ->setCodCategoria($p['cod_categoria'])
                    ->setCodFihcaTec($p['cod_fichapet']);

                 $pets[] = [
                    "cod" => $pet->getCod(),
                    "photo" => $pet->getPhoto(),
                    "descricao" => $pet->getDesc(),
                    "quantidade" => $pet->getEstoque(),
                    "nome" => $pet->getNome(),
                    "categoria" => $p['nome_categoria'],
                    "ficha_pet" => [
                        "cod" => $pet->getCodFihcaTec(),
                        "raca" => $p['raca'],
                        "alergias" => $p['alergias'],
                        "observacoes" => $p['observacoes'],
                        "tamanho" => $p['tamanho'],
                        "estoque" => $p['estoque']
                    ]
                ];
            }

            return $pets;

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findAll(PetEntity $pet)
    {
        $cnt = $this->db;
        try{
           $sql = "SELECT pet.*, c.nome_categoria, f.raca, f.alergias, f.observacoes, f.tamanho, f.estoque FROM pet INNER JOIN produto_categoria AS c
           ON pet.cod_categoria = c.cod
           INNER JOIN ficha_pet AS f
           ON pet.cod_fichapet = f.cod";
           
           $query = $cnt->prepare($sql);
           $query->execute();

           $datas = $query->fetchAll();
           if(empty($datas)){
              throw new Exception("nenhum produto registrado");
           }

           $pets = [];

           foreach($datas as $p){
                $pet->setCod($p['cod'])
                    ->setPhoto($p['photo'])
                    ->setDesc($p['descricao'])
                    ->setEstoque($p['quantidade'])
                    ->setNome($p['nome'])
                    ->setCodCategoria($p['cod_categoria'])
                    ->setCodFihcaTec($p['cod_fichapet']);

                 $pets[] = [
                    "cod" => $pet->getCod(),
                    "photo" => $pet->getPhoto(),
                    "descricao" => $pet->getDesc(),
                    "quantidade" => $pet->getEstoque(),
                    "nome" => $pet->getNome(),
                    "categoria" => $p['nome_categoria'],
                    "ficha_pet" => [
                        "cod" => $pet->getCodFihcaTec(),
                        "raca" => $p['raca'],
                        "alergias" => $p['alergias'],
                        "observacoes" => $p['observacoes'],
                        "tamanho" => $p['tamanho'],
                        "estoque" => $p['estoque']
                    ]
                ];
           }

           return $pets;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findByCategoria(PetEntity $pet, CategoriaEntity $categoria)
    {
        $cnt = $this->db;
        $nome_categoria = $categoria->getCategoriaName();
        try{
            $sql = "SELECT DISTINCT pet.*, c.nome_categoria, f.raca, f.alergias, f.observacoes, f.tamanho, f.estoque FROM pet INNER JOIN produto_categoria AS c
            ON pet.cod_categoria = c.cod
            AND c.nome_categoria = '$nome_categoria'
            INNER JOIN ficha_pet AS f
            ON pet.cod_fichapet = f.cod";

            $query = $cnt->prepare($sql);
            $query->execute();

            $dados = $query->fetchAll();

            if(empty($dados)){
                throw new Exception("nenhum pet registrado");
            }

            foreach($dados as $p){
                $pet->setCod($p['cod'])
                    ->setPhoto($p['photo'])
                    ->setDesc($p['descricao'])
                    ->setEstoque($p['quantidade'])
                    ->setNome($p['nome'])
                    ->setCodCategoria($p['cod_categoria'])
                    ->setCodFihcaTec($p['cod_fichapet']);

                 $pets[] = [
                    "cod" => $pet->getCod(),
                    "photo" => $pet->getPhoto(),
                    "descricao" => $pet->getDesc(),
                    "quantidade" => $pet->getEstoque(),
                    "nome" => $pet->getNome(),
                    "categoria" => $p['nome_categoria'],
                    "ficha_pet" => [
                        "cod" => $pet->getCodFihcaTec(),
                        "raca" => $p['raca'],
                        "alergias" => $p['alergias'],
                        "observacoes" => $p['observacoes'],
                        "tamanho" => $p['tamanho'],
                        "estoque" => $p['estoque']
                    ]
                ];
            }

            return $pets;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function updatePet(PetEntity $pet)
    {
        
    }

    public function deletePet(PetEntity $pet)
    {
        $cnt = $this->db;
        $idPet = $pet->getCod();

        try{
            $sql = "DELETE FROM pet WHERE pet.cod = '$idPet'";
            $query = $cnt->prepare($sql);
            $query->execute();

            if(!$query->rowCount()){
                throw new Exception("Pet nao existe");
            }

            return;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}