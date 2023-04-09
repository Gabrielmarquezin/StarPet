<?php
namespace Boringue\Backend\aplication\repositories;

use Boringue\Backend\aplication\repositories\contract\ProductRepositoryInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaProduto;
use Boringue\Backend\domain\entities\ProductEntity;
use Exception;

class ProductRepository implements ProductRepositoryInterface{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database::conexao();
    }

    public function add(ProductEntity $produto)
    {
        $db = $this->db;
        try{
            $data = [
                "photo" => $produto->getPhoto(),
                "cod_fichatec" => $produto->getCodFichaTec(),
                "cod_categoria" => $produto->getCodCategoria(),
                "descricao" => $produto->getDescricao(),
                "preco" => $produto->getPreco(),
                "quantidade" => $produto->getQuantidade(),
                "nome" => $produto->getNome()
            ];

            $sql = "INSERT INTO produto (photo, cod_fichatec, cod_categoria, descricao, preco, quantidade, nome) VALUES (:photo, :cod_fichatec, :cod_categoria, :descricao, :preco, :quantidade, :nome)";
            $query = $db->prepare($sql);
            $query->execute($data);

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function addCategoria(CategoriaEntity $categoria)
    {
        $cnt = $this->db;
        try{
            $data = [
                "nome_categoria" => $categoria->getCategoriaName()
            ];

            $sql = "INSERT INTO produto_categoria (nome_categoria) VALUES (:nome_categoria)";
            $query= $cnt->prepare($sql);
            $query->execute($data);

            $id = $cnt->lastInsertId();
        
            return $id;

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function addFichaTec(FichaProduto $ficha)
    {
        
    }

    public function findProductCategoria(CategoriaEntity $categoria)
    {
        $cnt = $this->db;
        $data = [
            "nome_categoria" => $categoria->getCategoriaName()
        ];

        try{
            $sql = "SELECT * FROM produto_categoria WHERE nome_categoria = :nome_categoria";
            $query = $cnt->prepare($sql);
            $query->execute($data);

            $categorias = [];
            $dados = $query -> fetchAll();

            foreach($dados as $c){
                $categorias[] = [
                    "nome_categoria" => $c['nome_categoria'],
                    "codigo" => $c["cod"]
                ];
            }
           
            return $categorias;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function find(ProductEntity $produto)
    {
        
    }

    public function findAll()
    {
        
    }

    public function delete()
    {
        
    }
}