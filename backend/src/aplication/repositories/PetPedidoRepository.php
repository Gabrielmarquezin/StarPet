<?php
namespace Boringue\Backend\aplication\repositories;

use Boringue\Backend\aplication\repositories\contract\pedido\PedidoProdutoRepositoryInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\pedido\PedidoProdutoEntity;
use Boringue\Backend\domain\entities\MethodPaymentEntity;
use Exception;

class PetPedidoRepository implements PedidoProdutoRepositoryInterface{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database::conexao();
    }

    public function addPedido(PedidoProdutoEntity $pedido, MethodPaymentEntity $method)
    {
        $cnt = $this->db;
        $dados_pedido = [
            "cod_user" => $pedido->getCodUser(),
            "cod_pet" => $pedido->getCodProduto(),
            "preco_total" => $pedido->getPreco(),
            "cpf" => $pedido->getCPF(),
            "rua" => $pedido->getRua(),
            "bairro" => $pedido->getBairro(),
            "telefone" => $pedido->getTelefone(),
            "cep" => $pedido->getCep(),
            "nome" => $pedido->getNome(),
            "email" => $pedido->getEmail(),
            "casa_number" => $pedido->getCasaN()
        ];

        $dados_forma_pagamento = [
            "method" => $method->getMethod(),
            "cod_transaction" => $method->getCodTransaction(),
            "estado" => $method->getState()
        ];

        try{
            $sql = "INSERT INTO forma_pagamento (method, cod_transaction, estado) 
            VALUES (:method, :cod_transaction, :estado)";

            $query = $cnt->prepare($sql);
            $query->execute($dados_forma_pagamento);

            $dados_pedido["cod_pagamento"] = $cnt->lastInsertId();

            $sql = "INSERT INTO pet_pedido (cod_user, cod_pet, preco_total, cpf, rua, bairro, telefone, cep, nome, email, casa_number, cod_pagamento)
            VALUES (:cod_user, :cod_pet, :preco_total, :cpf, :rua, :bairro, :telefone, :cep, :nome, :email, :casa_number, :cod_pagamento)";

            $query = $cnt->prepare($sql);
            $query->execute($dados_pedido);

            return $cnt->lastInsertId();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findPedido(PedidoProdutoEntity $pedido)
    {
        $cnt = $this->db;
        $id_user = $pedido->getCodUser();
        $id_produto = $pedido->getCodProduto();

        try{
            $sql = "SELECT u.nome, u.photo AS photo_user, p.data_pedido, p.email, p.cep, p.bairro, p.rua, p.casa_number, p.cod_user, p.cod_pet, p.telefone, p.preco_total, pet.photo AS pet_photo, pet.preco, pet.nome AS pet_name, f.method, f.cod_transaction, f.estado
            FROM pet_pedido AS p
            INNER JOIN users AS u
            ON p.cod_user = u.cod
            AND p.cod_user = '$id_user'
            INNER JOIN pet
            ON p.cod_pet = pet.cod
            AND p.cod_pet = '$id_produto'
            INNER JOIN forma_pagamento AS f
            ON p.cod_pagamento = f.cod
            ORDER BY p.data_pedido";

            $query = $cnt->prepare($sql);
            $query->execute();

            $dados = $query->fetchAll();
            if(empty($dados)){
                return $dados;
            }

            $pedido = [];
            foreach($dados as $p){
                if (ctype_xdigit(bin2hex($p["photo_user"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo_user"]);
                    $p["photo_user"] = $base64Image;
                }

                if (ctype_xdigit(bin2hex($p["pet_photo"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["pet_photo"]);
                    $p["pet_photo"] = $base64Image;
                }

                $pedido[] = [
                    "username" => $p['nome'],
                    "photo" => $p['photo_user'],
                    "email" => $p['email'],
                    "cep" => $p['cep'],
                    "bairro" => $p['bairro'],
                    "rua" => $p['rua'],
                    "casa_number" => $p['casa_number'],
                    "cod_user" => $p['cod_user'],
                    "telefone" => $p['telefone'],
                    "pet" => [
                        "cod_pet" => $p['cod_pet'],
                        "preco_total" => $p['preco_total'],
                        "photo" => $p['pet_photo'],
                        "preco_unit" => (float)$p['preco'],
                        "nome" => $p['pet_name']
                    ],
                    "payment" => [
                        "method" => $p['method'],
                        "transaction" => $p['cod_transaction'],
                        "status" => $p['estado'],
                        "data" => $p['data_pedido']
                    ]
                ];
            }

            return $pedido;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findPedidoByUser(PedidoProdutoEntity $pedido)
    {
        $cnt = $this->db;
        $id_user = $pedido->getCodUser();
        try{
            $sql = "SELECT u.nome, u.photo AS photo_user, p.data_pedido, p.email, p.cep, p.bairro, p.rua, p.casa_number, p.cod_user, p.cod_pet, p.telefone, p.preco_total, pet.photo AS pet_photo, pet.preco, pet.nome AS pet_name, c.nome_categoria, f.method, f.cod_transaction, f.estado
            FROM pet_pedido AS p
            INNER JOIN users AS u
            ON p.cod_user = u.cod
            AND p.cod_user = '$id_user'
            INNER JOIN pet
            ON p.cod_pet = pet.cod
            INNER JOIN produto_categoria as c
            ON pet.cod_categoria = c.cod
            INNER JOIN forma_pagamento AS f
            ON p.cod_pagamento = f.cod
            ORDER BY p.data_pedido";

            $query = $cnt->prepare($sql);
            $query->execute();

            $dados = $query->fetchAll();

            if(empty($dados)){
                return $dados;
            }

            $pedido = [];
            foreach($dados as $p){
                if (ctype_xdigit(bin2hex($p["photo_user"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo_user"]);
                    $p["photo_user"] = $base64Image;
                }

                if (ctype_xdigit(bin2hex($p["pet_photo"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["pet_photo"]);
                    $p["pet_photo"] = $base64Image;
                }
                
                $pedido[] = [
                    "username" => $p['nome'],
                    "photo" => $p['photo_user'],
                    "email" => $p['email'],
                    "cep" => $p['cep'],
                    "bairro" => $p['bairro'],
                    "rua" => $p['rua'],
                    "casa_number" => $p['casa_number'],
                    "cod_user" => $p['cod_user'],
                    "telefone" => $p['telefone'],
                    "pet" => [
                        "cod_pet" => $p['cod_pet'],
                        "preco_total" => $p['preco_total'],
                        "photo" => $p['pet_photo'],
                        "preco_unit" => (float)$p['preco'],
                        "nome" => $p['pet_name'],
                        "categoria" => $p['nome_categoria']
                    ],
                    "payment" => [
                        "method" => $p['method'],
                        "transaction" => $p['cod_transaction'],
                        "status" => $p['estado'],
                        "data" => $p['data_pedido']
                    ]
                ];
            }

            return $pedido;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findPedidoByCategoria(CategoriaEntity $categoria)
    {
        $cnt = $this->db;
        $nome_categoria = $categoria->getCategoriaName();

        try{
            $sql = "SELECT u.nome, u.photo AS photo_user, p.data_pedido, p.email, p.cep, p.bairro, p.rua, p.casa_number, p.cod_user, p.cod_pet, p.telefone, p.preco_total, pet.photo AS pet_photo, pet.preco, pet.nome AS pet_name, c.nome_categoria, f.method, f.cod_transaction, f.estado
            FROM pet_pedido AS p
            INNER JOIN users AS u
            ON p.cod_user = u.cod
            INNER JOIN pet
            ON p.cod_pet = pet.cod
            INNER JOIN produto_categoria as c
            ON pet.cod_categoria = c.cod
            AND c.nome_categoria = '$nome_categoria'
            INNER JOIN forma_pagamento AS f
            ON p.cod_pagamento = f.cod
            ORDER BY p.data_pedido";

            $query = $cnt->prepare($sql);
            $query->execute();

            $dados = $query->fetchAll();

            if(empty($dados)){
                return $dados;
            }

            $pedido = [];
            foreach($dados as $p){
                if (ctype_xdigit(bin2hex($p["photo_user"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo_user"]);
                    $p["photo_user"] = $base64Image;
                }

                if (ctype_xdigit(bin2hex($p["pet_photo"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["pet_photo"]);
                    $p["pet_photo"] = $base64Image;
                }
                $pedido[] = [
                    "username" => $p['nome'],
                    "photo" => $p['photo_user'],
                    "email" => $p['email'],
                    "cep" => $p['cep'],
                    "bairro" => $p['bairro'],
                    "rua" => $p['rua'],
                    "casa_number" => $p['casa_number'],
                    "cod_user" => $p['cod_user'],
                    "telefone" => $p['telefone'],
                    "pet" => [
                        "cod_pet" => $p['cod_pet'],
                        "preco_total" => $p['preco_total'],
                        "photo" => $p['pet_photo'],
                        "preco_unit" => (float)$p['preco'],
                        "nome" => $p['pet_name'],
                        "categoria" => $p['nome_categoria']
                    ],
                    "payment" => [
                        "method" => $p['method'],
                        "transaction" => $p['cod_transaction'],
                        "status" => $p['estado'],
                        "data" => $p['data_pedido']
                    ]
                ];
            }

            return $pedido;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findAllPedido()
    {
        $cnt = $this->db;
        try{
            $sql = "SELECT u.nome, u.photo AS photo_user, p.data_pedido, p.email, p.cep, p.bairro, p.rua, p.casa_number, p.cod_user, p.cod_pet, p.telefone, p.preco_total, pet.photo AS pet_photo, pet.preco, pet.nome AS pet_name, c.nome_categoria, f.method, f.cod_transaction, f.estado
            FROM pet_pedido AS p
            INNER JOIN users AS u
            ON p.cod_user = u.cod
            INNER JOIN pet
            ON p.cod_pet = pet.cod
            INNER JOIN produto_categoria as c
            ON pet.cod_categoria = c.cod
            INNER JOIN forma_pagamento AS f
            ON p.cod_pagamento = f.cod
            ORDER BY p.data_pedido";

            $query = $cnt->prepare($sql);
            $query->execute();

            $dados = $query->fetchAll();

            if(empty($dados)){
                return $dados;
            }

            $pedido = [];
            foreach($dados as $p){
                if (ctype_xdigit(bin2hex($p["photo_user"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo_user"]);
                    $p["photo_user"] = $base64Image;
                }

                if (ctype_xdigit(bin2hex($p["pet_photo"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["pet_photo"]);
                    $p["pet_photo"] = $base64Image;
                }


                $pedido[] = [
                    "username" => $p['nome'],
                    "photo" => $p['photo_user'],
                    "email" => $p['email'],
                    "cep" => $p['cep'],
                    "bairro" => $p['bairro'],
                    "rua" => $p['rua'],
                    "casa_number" => $p['casa_number'],
                    "cod_user" => $p['cod_user'],
                    "telefone" => $p['telefone'],
                    "pet" => [
                        "cod_pet" => $p['cod_pet'],
                        "preco_total" => $p['preco_total'],
                        "photo" => $p['pet_photo'],
                        "preco_unit" => (float)$p['preco'],
                        "nome" => $p['pet_name'],
                        "categoria" => $p['nome_categoria']
                    ],
                    "payment" => [
                        "method" => $p['method'],
                        "transaction" => $p['cod_transaction'],
                        "status" => $p['estado'],
                        "data" => $p['data_pedido']
                    ]
                ];
            }

            return $pedido;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function DeletePedido(PedidoProdutoEntity $pedido){
        $cnt = $this->db;
        $id_produto = $pedido->getCodProduto();
        $id_user = $pedido->getCodUser();
        try{
            $sql = "DELETE FROM pet_pedido WHERE cod_user = '$id_user' AND cod_pet = '$id_produto'";
            $query = $cnt->prepare($sql);
            $query->execute();

            if(!$query->rowCount()){
                throw new Exception("User ou Pet nao identificado");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}