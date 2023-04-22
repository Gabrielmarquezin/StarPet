<?php
namespace Boringue\Backend\aplication\repositories;

use Avaliacao;
use Boringue\Backend\aplication\repositories\contract\AvaliacaoRepositoryInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\AvaliacaoEntity;
use Exception;


class AvaliacaoRepository implements AvaliacaoRepositoryInterface{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database::conexao();
    }

    public function addMessage(AvaliacaoEntity $avaliacao)
    {
        $cnt = $this->db;
        $dados = [
            "quantidade_stars" => $avaliacao->getStar(),
            "mensagem" => $avaliacao->getMessage(),
            "cod_user" => $avaliacao->getCodUser(),
            "cod_produto" => $avaliacao->getCodProduto()
        ];

        try{
            $sql = "INSERT INTO avaliacao (quantidade_stars, mensagem, cod_user, cod_produto)
            VALUES (:quantidade_stars, :mensagem, :cod_user, :cod_produto)";

            $query = $cnt->prepare($sql);
            $query->execute($dados);

            $id = $cnt->lastInsertId();

            return $id;
        }catch(Exception $e){
            throw new Exception("produto nao existe");
        }
    }

    public function addMessagePet(AvaliacaoEntity $avaliacao)
    {
        $cnt = $this->db;
        $dados = [
            "quantidade_stars" => $avaliacao->getStar(),
            "mensagem" => $avaliacao->getMessage(),
            "cod_user" => $avaliacao->getCodUser(),
            "cod_pet" => $avaliacao->getCodProduto()
        ];

        try{
            $sql = "INSERT INTO avaliacao_pet (quantidade_stars, mensagem, cod_user, cod_pet)
            VALUES (:quantidade_stars, :mensagem, :cod_user, :cod_pet)";

            $query = $cnt->prepare($sql);
            $query->execute($dados);

            $id = $cnt->lastInsertId();

            return $id;
        }catch(Exception $e){
            throw new Exception("produto nao existe");
        }
    }

    public function addMessagePetAdocao(AvaliacaoEntity $avaliacao)
    {
        $cnt = $this->db;
        $dados = [
            "quantidade_stars" => $avaliacao->getStar(),
            "mensagem" => $avaliacao->getMessage(),
            "cod_user" => $avaliacao->getCodUser(),
            "cod_pet_adocao" => $avaliacao->getCodProduto()
        ];

        try{
            $sql = "INSERT INTO avaliacao_adocao (quantidade_stars, mensagem, cod_user, cod_pet_adocao)
            VALUES (:quantidade_stars, :mensagem, :cod_user, :cod_pet_adocao)";

            $query = $cnt->prepare($sql);
            $query->execute($dados);

            $id = $cnt->lastInsertId();

            return $id;
        }catch(Exception $e){
            throw new Exception("produto nao existe");
        }
    }

    public function findMessage(AvaliacaoEntity $avaliacao)
    {
        $cnt = $this->db;
        $idProduto = $avaliacao->getCodProduto();
        try{
            $sql = "SELECT a.cod AS cod_mensagem, a.quantidade_stars, a.mensagem, a.cod_produto, a.data_mensagem, users.* FROM avaliacao AS a INNER JOIN users
            ON a.cod_user = users.cod
            WHERE a.cod_produto = '$idProduto'";

            $query = $cnt->prepare($sql);
            $query -> execute();

            $dados = $query->fetchAll();

            if(!empty($dados)){
                $mensagens = [];
                foreach($dados as $m){
                    $avaliacao->setCod($m['cod_mensagem'])
                              ->setCodProduto($m['cod_produto'])
                              ->setCodUser($m['cod'])
                              ->setMessage($m['mensagem'])
                              ->setStar($m['quantidade_stars']);
                    
                    $mensagens[] = [
                        "cod" => $avaliacao->getCod(),
                        "cod_user" => $avaliacao->getCodUser(),
                        "cod_produto" => $avaliacao->getCodProduto(),
                        "mensagem" => $avaliacao->getMessage(),
                        "stars" => $avaliacao->getStar(),
                        "data" => $m['data_mensagem'],
                        "usuario" => [
                            "photo" => $m['photo'],
                            "nome" => $m['nome'],
                            "email" => $m['email']
                        ]
                    ];
                }

               return $mensagens;
            }

            return $dados;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function findMessageAdocao(AvaliacaoEntity $avaliacao)
    {
        $cnt = $this->db;
        $idProduto = $avaliacao->getCodProduto();
        try{
            $sql = "SELECT a.cod AS cod_mensagem, a.quantidade_stars, a.mensagem, a.cod_pet_adocao, a.data_mensagem, users.* FROM avaliacao_adocao AS a INNER JOIN users
            ON a.cod_user = users.cod
            WHERE a.cod_pet_adocao = '$idProduto'";

            $query = $cnt->prepare($sql);
            $query -> execute();

            $dados = $query->fetchAll();

            if(!empty($dados)){
                $mensagens = [];
                foreach($dados as $m){
                    $avaliacao->setCod($m['cod_mensagem'])
                              ->setCodProduto($m['cod_pet_adocao'])
                              ->setCodUser($m['cod'])
                              ->setMessage($m['mensagem'])
                              ->setStar($m['quantidade_stars']);
                    
                    $mensagens[] = [
                        "cod" => $avaliacao->getCod(),
                        "cod_user" => $avaliacao->getCodUser(),
                        "cod_pet" => $avaliacao->getCodProduto(),
                        "mensagem" => $avaliacao->getMessage(),
                        "stars" => $avaliacao->getStar(),
                        "data" => $m['data_mensagem'],
                        "usuario" => [
                            "photo" => $m['photo'],
                            "nome" => $m['nome'],
                            "email" => $m['email']
                        ]
                    ];
                }
            
               return $mensagens;
            }

            return $dados;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function findMessagePet(AvaliacaoEntity $avaliacao)
    {
        $cnt = $this->db;
        $idProduto = $avaliacao->getCodProduto();
        try{
            $sql = "SELECT a.cod AS cod_mensagem, a.quantidade_stars, a.mensagem, a.cod_pet, a.data_mensagem, users.*  FROM avaliacao_pet AS a INNER JOIN users
            ON a.cod_user = users.cod
            WHERE a.cod_pet = '$idProduto'";

            $query = $cnt->prepare($sql);
            $query -> execute();

            $dados = $query->fetchAll();

            if(!empty($dados)){
                $mensagens = [];
                foreach($dados as $m){
                    $avaliacao->setCod($m['cod_mensagem'])
                              ->setCodProduto($m['cod_pet'])
                              ->setCodUser($m['cod'])
                              ->setMessage($m['mensagem'])
                              ->setStar($m['quantidade_stars']);
                    
                    $mensagens[] = [
                        "cod" => $avaliacao->getCod(),
                        "cod_user" => $avaliacao->getCodUser(),
                        "cod_pet" => $avaliacao->getCodProduto(),
                        "mensagem" => $avaliacao->getMessage(),
                        "stars" => $avaliacao->getStar(),
                        "data" => $m['data_mensagem'],
                        "usuario" => [
                            "photo" => $m['photo'],
                            "nome" => $m['nome'],
                            "email" => $m['email']
                        ]
                    ];
                }

               return $mensagens;
            }

            return $dados;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function updateMessage(AvaliacaoEntity $avaliacao, string $table_name)
    {
        $cnt = $this->db;
        $mensagem = $avaliacao->getMessage();
        $idavaliacao = $avaliacao->getCod();

        try{
            $sql = "UPDATE $table_name SET mensagem = '$mensagem' WHERE cod = '$idavaliacao'";
            $query = $cnt->prepare($sql);
            $query->execute();

            if(!$query->rowCount()){
                throw new Exception("mensage don't exist");
            }

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    
    public function deleteMessage(AvaliacaoEntity $avaliacao, string $table_name)
    {
        $cnt = $this->db;
        $idavaliacao = $avaliacao->getCod();

        try{
            $sql = "DELETE FROM $table_name WHERE $table_name.cod =  '$idavaliacao'";
            $query = $cnt->prepare($sql);
            $query->execute();

            if(!$query->rowCount()){
                throw new Exception("mensagem nao existe");
            }

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}