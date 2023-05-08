<?php
namespace Boringue\Backend\aplication\repositories;

use Boringue\Backend\aplication\repositories\contract\ProductRepositoryInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaProduto;
use Boringue\Backend\domain\entities\FichaProdutoEntity;
use Boringue\Backend\domain\entities\ProductEntity;
use Exception;
use FichaTecnica;
use Produto;

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

    public function addFichaTec(FichaProdutoEntity $ficha)
    {
        $cnt = $this->db;
        $data = [
            "linha" => $ficha->getLinha(),
            "modelo" => $ficha->getTamanho(),
            "marca" => $ficha->getMarca(),
            "tamanho" => $ficha->getTamanho(),
            "cor" => $ficha->getCor(),
            "estoque" => $ficha->getTamanho()
        ];

        try{
            $sql = "INSERT INTO ficha_tecnica (linha, modelo, marca, tamanho, cor, estoque) VALUES (:linha, :modelo, :marca, :tamanho, :cor, :estoque)";
            $query = $cnt->prepare($sql);
            $query->execute($data);

            $id = $cnt->lastInsertId();
            return $id;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function findCategoriaForName(CategoriaEntity $categoria)
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

    // public function findCategoriaForId($idcategoria)
    // {
    //     $cnt = $this->db;
    //     try{
    //         $sql = "SELECT nome_categoria FROM produto_categoria WHERE cod = '$idcategoria'";
    //         $query = $cnt->prepare($sql);
    //         $query->execute();

    //         $dados = $query->fetchAll();
            
    //         return $dados[0];
    //     }catch(Exception $e){
    //         echo $e->getMessage();
    //     }
    // }

    // public function findFichaTecnica(FichaProdutoEntity $fichaTecnica)
    // {
    //     $cnt = $this->db;
    //     $idTec = $fichaTecnica->getCod();

    //     try{
    //         $sql = "SELECT * FROM ficha_tecnica WHERE cod = '$idTec'";
    //         $query = $cnt->prepare($sql);
    //         $query -> execute();

    //         $dados = $query->fetchAll();
    //         $fichas = [];

    //         foreach($dados as $f){
    //             $fichaTecnica->setCod($f['cod'])
    //                          ->setLinha($f['linha'])
    //                          ->setModelo($f['modelo'])
    //                          ->setMarca($f['marca'])
    //                          ->setTamanho($f['tamanho'])
    //                          ->setCor($f['cor'])
    //                          ->setEstoque($f['estoque']);
    //             $fichas[] = [
    //                 "cod" => $fichaTecnica->getCod(),
    //                 "linha" => $fichaTecnica->getLinha(),
    //                 "modelo" => $fichaTecnica->getModelo(),
    //                 "marca" => $fichaTecnica->getMarca(),
    //                 "tamanho" => $fichaTecnica->getTamanho(),
    //                 "cor" => $fichaTecnica->getCor(),
    //                 "estoque" => $fichaTecnica->getEstoque()
    //             ];
    //         }
            
    //         return $fichas;
    //     }catch(Exception $e){
    //         echo $e->getMessage();
    //     }
    // }

    public function find(ProductEntity $produto, FichaProdutoEntity $ficha_tecnica)
    {
        $cnt = $this->db;
        $cod_produto = $produto->getCod();
        
        try{
            $sql = "SELECT produto.*, c.nome_categoria, f.linha, f.modelo, f.marca, f.tamanho, f.cor, f.estoque FROM produto INNER JOIN produto_categoria AS c
            ON produto.cod_categoria = c.cod
            AND produto.cod = '$cod_produto'
            INNER JOIN ficha_tecnica AS f
            ON produto.cod_fichatec = f.cod
            WHERE produto.cod = '$cod_produto'";

            $query = $cnt->prepare($sql);
            $query->execute();

            $produto_retornado = $query->fetchAll();
            $product = [];
           
           
            foreach($produto_retornado as $p){
                 
                $produto->setCod($p['cod'])
                        ->setPhoto($p['photo'])
                        ->setDescricao($p['descricao'])
                        ->setPreco($p['preco'])
                        ->setQuantidade($p['quantidade'])
                        ->setNome($p['nome']);

                if (ctype_xdigit(bin2hex($produto->getPhoto()))) {
                    // o campo é binário
                    $base64Image = base64_encode($produto->getPhoto());
                    $produto->setPhoto($base64Image);
                }

        
                $ficha_tecnica->setCod($p['cod_fichatec'])
                              ->setLinha($p['linha'])
                              ->setModelo($p['modelo'])
                              ->setMarca($p['marca'])
                              ->setTamanho($p['tamanho'])
                              ->setCor($p['cor'])
                              ->setEstoque($p['estoque']);
    
                $product[] = [
                    "cod" => $produto->getCod(),
                    "photo" => $produto->getPhoto(),
                    "ficha_tec" => [
                        "cod" => $ficha_tecnica->getCod(),
                        "linha" => $ficha_tecnica->getLinha(),
                        "modelo" => $ficha_tecnica->getModelo(),
                        "marca" => $ficha_tecnica->getMarca(),
                        "tamanho" => $ficha_tecnica->getTamanho(),
                        "cor" => $ficha_tecnica->getCor(),
                        "estoque" => $ficha_tecnica->getEstoque()
                    ],
                    "categoria" => $p["nome_categoria"],
                    "descricao" => $produto->getDescricao(),
                    "preco" => $produto->getPreco(),
                    "quantidade" => $produto->getQuantidade(),
                    "nome" => $produto->getNome() 
                ];
                        
            }
           
            return $product;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function findAll()
    {
       $cnt = $this->db;

       try{
        $sql = "SELECT DISTINCT produto.*, c.nome_categoria, f.linha, f.modelo, f.marca, f.tamanho, f.cor, f.estoque FROM produto INNER JOIN produto_categoria AS c
                ON produto.cod_categoria = c.cod
                INNER JOIN ficha_tecnica AS f
                ON produto.cod_fichatec = f.cod";

           $query = $cnt->prepare($sql);
           $query->execute();

           $datas = $query->fetchAll();
           $produtos = [];

           foreach($datas as $p){

                if (ctype_xdigit(bin2hex($p["photo"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo"]);
                    $p["photo"] = $base64Image;
                }

                $produtos[] = [
                    "cod" => $p["cod"],
                    "photo" => $p["photo"],
                    "ficha_tec" => [
                        "cod" => $p["cod_fichatec"],
                        "linha" => $p["linha"],
                        "modelo" => $p["modelo"],
                        "marca" => $p["marca"],
                        "tamanho" => $p["tamanho"],
                        "cor" => $p["cor"],
                        "estoque" => $p["estoque"]
                    ],
                    "categoria" => $p["nome_categoria"],
                    "descricao" => $p["descricao"],
                    "preco" => $p["preco"],
                    "quantidade" => $p["quantidade"],
                    "nome" => $p["nome"]
                ];

           };
        

           return $produtos;
       }catch(Exception $e){
          echo $e->getMessage();
       }
    }

    public function findByCategoria(CategoriaEntity $categoria_entity)
    {
        $cnt = $this->db;
        $nome_categoria = $categoria_entity->getCategoriaName();
        try{
            $sql = "SELECT DISTINCT produto.*, c.nome_categoria, f.linha, f.modelo, f.marca, f.tamanho, f.cor, f.estoque FROM produto INNER JOIN produto_categoria AS c
            ON produto.cod_categoria = c.cod
            AND c.nome_categoria = '$nome_categoria'
            INNER JOIN ficha_tecnica AS f
            ON produto.cod_fichatec = f.cod";

            $query = $cnt->prepare($sql);
            $query->execute();

            $dados = $query->fetchAll();

            if(empty($dados)){
                throw new Exception("empty products");
            }

            $produtos = [];

            foreach($dados as $p){
                if (ctype_xdigit(bin2hex($p["photo"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo"]);
                    $p["photo"] = $base64Image;
                }

                $produtos[] = [
                    "cod" => $p["cod"],
                    "photo" => $p["photo"],
                    "ficha_tec" => [
                        "cod" => $p["cod_fichatec"],
                        "linha" => $p["linha"],
                        "modelo" => $p["modelo"],
                        "marca" => $p["marca"],
                        "tamanho" => $p["tamanho"],
                        "cor" => $p["cor"],
                        "estoque" => $p["estoque"]
                    ],
                    "categoria" => $p["nome_categoria"],
                    "descricao" => $p["descricao"],
                    "preco" => $p["preco"],
                    "quantidade" => $p["quantidade"],
                    "nome" => $p["nome"]
                ];

            }
            return $produtos;

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function update(ProductEntity $produto)
    {
        $cnt = $this->db;
        $data = [
            'cod' => $produto->getCod(),
            'photo' => $produto->getPhoto(),
            'descricao' => $produto->getDescricao(),
            'preco' => $produto->getPreco(),
            'nome' => $produto->getNome()
        ];
        
        try{
            $sql = "UPDATE produto SET photo = :photo, descricao = :descricao, preco = :preco, nome = :nome WHERE cod = :cod";
            $query = $cnt->prepare($sql);
            $query->execute($data);

            if(!$query->rowCount()){
                throw new Exception("Produto nao existe ou produto nao tem o que atualizar");
            }

            return "atualizado";
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function delete($idProduto)
    {
        $cnt = $this->db;
        try{
            $sql = "DELETE FROM produto WHERE produto.cod = '$idProduto'";
            $query = $cnt->prepare($sql);
            $query->execute();

            if(!$query->rowCount()){
                throw new Exception("Produto nao existe");
            }

            return "Deletado";
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}