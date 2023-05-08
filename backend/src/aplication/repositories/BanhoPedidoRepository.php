<?php
namespace Boringue\Backend\aplication\repositories;

use Boringue\Backend\aplication\repositories\contract\pedido\PedidoBanhoRepositoryInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\AgendaBanhoEntity;
use Boringue\Backend\domain\entities\pedido\PedidoBanhoEntity;
use Boringue\Backend\domain\entities\HorarioBanhoEntity;
use Boringue\Backend\domain\entities\MethodPaymentEntity;
use Exception;

class BanhoPedidoRepository implements PedidoBanhoRepositoryInterface{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database::conexao();
    }

    public function addBanho(AgendaBanhoEntity $agenda, PedidoBanhoEntity $pedido, MethodPaymentEntity $method)
    {
        $cnt = $this->db;

        $dados_pedido = [
            "cod_user" => $pedido->getCodUser(),
            "valor_total" => $pedido->getPreco()
        ];

        try{
            
            $dados_pedido["cod_agenda"] = $this->addAgenda($agenda);
            $dados_pedido["cod_payment"] = $this->addPagamento($method);

            $sql = "INSERT INTO banho_pedido (cod_agenda, cod_user, valor_total, cod_payment) VALUES (:cod_agenda, :cod_user, :valor_total, :cod_payment)";
            $query = $cnt->prepare($sql);
            $query->execute($dados_pedido);

            return "ok";

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    private function addAgenda(AgendaBanhoEntity $agenda){
        $cnt = $this->db;
        $dados_agenda = [
            "pet_name" => $agenda->getPetName(),
            "email" => $agenda->getEmail(),
            "telefone" => $agenda->getTelefone(),
            "observacoes" => $agenda->getObservacoes(),
            "kit_banho" => $agenda->getKitBanho(),
            "cod_horario" => $agenda->getCodHorario()
        ];
        try{
            $sql = "INSERT INTO banho_agenda (pet_name, email, telefone, observacoes, kit_banho, cod_horario) VALUES (:pet_name, :email, :telefone, :observacoes, :kit_banho, :cod_horario)";
            $query = $cnt->prepare($sql);
            $query->execute($dados_agenda);

            return $cnt->lastInsertId();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    private function addPagamento(MethodPaymentEntity $method){
        $cnt = $this->db;
        $dados_pagamento = [
            "method" => $method->getMethod(),
            "cod_transaction" => $method->getCodTransaction(),
            "estado" => $method->getState()
        ];
        try{
            $sql = "INSERT INTO forma_pagamento (method, cod_transaction, estado) VALUES (:method, :cod_transaction, :estado)";
            $query = $cnt->prepare($sql);
            $query->execute($dados_pagamento);

            return $cnt->lastInsertId();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function addHorario(HorarioBanhoEntity $horario)
    {
        $cnt = $this->db;
        $date = $horario->getHorario();
        try{
            $sql = "INSERT INTO banho_horario (horario) VALUES ('$date')";
            $query = $cnt->prepare($sql);
            $query->execute();

            return $cnt->lastInsertId();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findBanho(PedidoBanhoEntity $pedido)
    {
        $cnt = $this->db;
        $cod_user = $pedido->getCodUser();
        try{
            $sql = "SELECT u.nome AS username, u.photo AS photo_user, a.pet_name, a.email, a.telefone, a.observacoes, a.kit_banho, a.cod_horario, h.horario, b.valor_total, b.data_agenda, b.cod_payment, f.method, f.cod_transaction, f.estado
            FROM banho_pedido as b
            INNER JOIN banho_agenda as a
            ON a.cod = b.cod_agenda
            INNER JOIN users as u
            ON b.cod_user = u.cod
            AND b.cod_user = '$cod_user'
            INNER JOIN banho_horario as h
            ON a.cod_horario = h.cod
            INNER JOIN forma_pagamento as f
            ON f.cod = b.cod_payment
            ORDER BY b.data_agenda";

            $query = $cnt->prepare($sql);
            $query->execute();

            $fetch_data = $query->fetchAll();
            if(empty($fetch_data)){
                return $fetch_data;
            }

            $datas = [];
            foreach($fetch_data as $p){
                if (ctype_xdigit(bin2hex($p["photo_user"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo_user"]);
                    $p["photo_user"] = $base64Image;
                }

                $datas[] = [
                    "username" => $p["username"],
                    "photo_user" => $p["photo_user"],
                    "email" => $p["email"],
                    "telefone" => $p["telefone"],
                    "pet" => [
                        "nome" => $p["pet_name"],
                        "observacoes" => $p["observacoes"],
                    ],
                    "banho" => [
                        "kit" => $p["kit_banho"],
                        "preco" => $p["valor_total"],
                        "data_pedido" => $p["data_agenda"],
                        "horario" => $p["horario"],
                        "cod_horario" => $p["cod_horario"]
                    ],
                    "payment" => [
                        "method" => $p["method"],
                        "cod" => $p["cod_payment"],
                        "cod_transaction" => $p["cod_transaction"],
                        "estado" => $p["estado"]

                    ]
                ];
            }

            return $datas;

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findHorario()
    {
        $cnt = $this->db;
        try{
            $sql = "SELECT * FROM banho_horario";
            $query = $cnt->prepare($sql);
            $query->execute();

            $fetch_data = $query->fetchAll();
            
            if(empty($fetch_data)){
                return $fetch_data;
            }

            $data = [];
            foreach($fetch_data as $p){
                $data[] = [
                    "cod_horario" => $p['cod'],
                    "horario" => $p['horario']
                ];
            }

            return $data;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function findAll()
    {
        $cnt = $this->db;
        try{
            $sql = "SELECT u.nome AS username, u.photo AS photo_user, a.pet_name, a.email, a.telefone, a.observacoes, a.kit_banho, a.cod_horario, h.horario, b.valor_total, b.data_agenda, b.cod_payment, f.method, f.cod_transaction, f.estado
            FROM banho_pedido as b
            INNER JOIN banho_agenda as a
            ON a.cod = b.cod_agenda
            INNER JOIN users as u
            ON b.cod_user = u.cod
            INNER JOIN banho_horario as h
            ON a.cod_horario = h.cod
            INNER JOIN forma_pagamento as f
            ON f.cod = b.cod_payment
            ORDER BY b.data_agenda";

            $query = $cnt->prepare($sql);
            $query->execute();

            $fetch_data = $query->fetchAll();
            if(empty($fetch_data)){
                return $fetch_data;
            }

            $datas = [];
            foreach($fetch_data as $p){
                if (ctype_xdigit(bin2hex($p["photo_user"]))) {
                    // o campo é binário
                    $base64Image = base64_encode($p["photo_user"]);
                    $p["photo_user"] = $base64Image;
                }
                
                $datas[] = [
                    "username" => $p["username"],
                    "photo_user" => $p["photo_user"],
                    "email" => $p["email"],
                    "telefone" => $p["telefone"],
                    "pet" => [
                        "nome" => $p["pet_name"],
                        "observacoes" => $p["observacoes"],
                    ],
                    "banho" => [
                        "kit" => $p["kit_banho"],
                        "preco" => $p["valor_total"],
                        "data_pedido" => $p["data_agenda"],
                        "horario" => $p["horario"],
                        "cod_horario" => $p["cod_horario"]
                    ],
                    "payment" => [
                        "method" => $p["method"],
                        "cod" => $p["cod_payment"],
                        "cod_transaction" => $p["cod_transaction"],
                        "estado" => $p["estado"]

                    ]
                ];
            }

            return $datas;

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deleteHorario(HorarioBanhoEntity $horario)
    {
        $cnt = $this->db;
        $cod_horario = $horario->getCod();
        try{
            $this->UpdateHorarioForTable($horario);

            $sql = "DELETE FROM  banho_horario WHERE cod = '$cod_horario'";
            $query = $cnt->prepare($sql);
            $query->execute();

            if(!$query->rowCount()){
                throw new Exception("Horario nao identificado");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    private function UpdateHorarioForTable(HorarioBanhoEntity $horario)
    {
        $cnt = $this->db;
        $cod_horario = $horario->getCod();
        try{
            $sql = "UPDATE banho_agenda SET cod_horario = '1' WHERE cod_horario = '$cod_horario'";
            $query = $cnt->prepare($sql);
            $query->execute();

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}