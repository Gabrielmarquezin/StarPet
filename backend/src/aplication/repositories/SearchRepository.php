<?php
namespace Boringue\Backend\aplication\repositories;

use Boringue\Backend\aplication\repositories\contract\SearchRepositoryInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\ProductEntity;
use Exception;
use Produto;
use React\Dns\Query\RetryExecutor;

class SearchRepository implements SearchRepositoryInterface{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database::conexao();
    }
    
    public function search(ProductEntity $product)
    {
        $cnt = $this->db;
        $nome = $product->getNome();

        try {
            $sql = "SELECT pet.*, c.nome_categoria, f.raca, f.alergias, f.observacoes, f.tamanho, f.estoque  FROM pet 
            INNER JOIN produto_categoria AS c
            ON pet.cod_categoria = c.cod
            INNER JOIN ficha_pet AS f
            ON pet.cod_fichapet = f.cod
            WHERE pet.nome LIKE '%$nome%'";

            $query = $cnt->prepare($sql);
            $query->execute();

            $pets = $query->fetchAll();

            $sql = "SELECT produto.*, c.nome_categoria, f.linha, f.modelo, f.marca, f.tamanho, f.cor, f.estoque  FROM produto 
            INNER JOIN produto_categoria AS c
            ON produto.cod_categoria = c.cod
            INNER JOIN ficha_tecnica AS f
            ON produto.cod_fichatec = f.cod
            WHERE produto.nome LIKE '%$nome%'";


            $query = $cnt->prepare($sql);
            $query->execute();

            $produtos = $query->fetchAll();

            $dados = [];

            if(!empty($pets)){
                foreach($pets as $p){
                    
                    if (ctype_xdigit(bin2hex($p["photo"]))) {
                        // o campo é binário
                        $base64Image = base64_encode($p["photo"]);
                        $p["photo"] = $base64Image;
                    }

                    $dados[] = [
                        "cod" => $p["cod"],
                        "photo" => $p["photo"],
                        "descricao" => $p["descricao"],
                        "quantidade" => $p["quantidade"],
                        "nome" => $p["nome"],
                        "categoria" => $p["nome_categoria"],
                        "preco" => $p["preco"],
                        "ficha_pet" => [
                            "raca" => $p['raca'],
                            "alergias" => $p['alergias'],
                            "observacoes" => $p['observacoes'],
                            "tamanho" => $p['tamanho'],
                            "estoque" => $p['estoque']
                        ],
                        "creat_at" => $p["creat_at"]
                    ];
                 }
            }

            if(!empty($produtos)){

               foreach($produtos as $p){
                    if (ctype_xdigit(bin2hex($p["photo"]))) {
                        // o campo é binário
                        $base64Image = base64_encode($p["photo"]);
                        $p["photo"] = $base64Image;
                    }

                    $dados[] = [
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
                        "nome" => $p["nome"],
                        "tipo" => $p["tipo"],
                        "creat_at" => $p["creat_at"]
                    ];
               }
            }

            return $dados;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}