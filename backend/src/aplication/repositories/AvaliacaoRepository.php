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

    public function updateMessage(AvaliacaoEntity $avaliacao)
    {
        $cnt = $this->db;
        $mensagem = $avaliacao->getMessage();
        $idavaliacao = $avaliacao->getCod();
        try{
            $sql = "UPDATE avaliacao SET mensagem = '$mensagem' WHERE avaliacao.cod = '$idavaliacao'";
            $query = $cnt->prepare($sql);
            $query->execute();

            if(!$query->rowCount()){
                throw new Exception("mensage don't exist");
            }

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deleteMessage(AvaliacaoEntity $avaliacao)
    {
        $cnt = $this->db;
        $idavaliacao = $avaliacao->getCod();

        try{
            $sql = "DELETE FROM avaliacao WHERE avaliacao.cod =  '$idavaliacao'";
            $query = $cnt->prepare($sql);
            $query->execute();

        }catch(Exception $e){
            throw new Exception("mensagem nao existe");
        }
    }
}