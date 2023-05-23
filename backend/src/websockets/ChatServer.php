<?php
namespace Boringue\Backend\websockets;

require __DIR__ . "../../../vendor/autoload.php";

use Boringue\Backend\aplication\repositories\AvaliacaoRepository;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\AvaliacaoEntity;
use Boringue\Backend\http\middlewares\DataVerification;
use Exception;
use SplObjectStorage;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

final class ChatServer implements MessageComponentInterface
{
    private $clients;

    public function __construct()
    {
        $this->clients = new SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        $url = $conn->httpRequest->getUri()->getPath();
        $this->clients->attach($conn);
        $this->clients->attach($conn, [
            "uri" => (explode("/", $url))[1]
        ]);
    }

    public function onMessage(ConnectionInterface $from, $msg): void
    {
        foreach ($this->clients as $client) {
            global $response, $allmsg;
            $middleware = new DataVerification();
            $data = json_decode($msg);
            $url = $this->clients[$from]['uri'];

            if(is_object($data)){
                $data = (array) $data;
                $message = new AvaliacaoEntity();
                $message->setStar($data["stars"])
                    ->setMessage($data['message'])
                    ->setCodUser($data["cod_user"]);
                $response = new AvaliacaoRepository(new Database());

                try{
                    $middleware->ValueLenght($data["message"], 1500);
                    $middleware->EmptyValues($data);

                    switch($url){
                        case "produto":
                            $message->setCodProduto($data['cod_produto']);
                            $response->addMessage($message);
                            $allmsg = json_encode($response->findMessage($message));
                            break;

                        case "pet":
                            $message->setCodProduto($data['cod_pet']);
                            $response->addMessagePet($message);
                            $allmsg = json_encode($response->findMessagePet($message));
                            break;
                        
                        case "adocao":
                            $message->setCodProduto($data['cod_pet_adocao']);
                            $response->findMessageAdocao($message);
                            $allmsg = json_encode($response->findMessageAdocao($message));
                            break;

                        default:
                            $client->send("rotas erradas");
                            return;
                    }
                    
                    $client->send(json_encode($allmsg));
                }catch(Exception $e){
                    $client->send($e->getMessage());
                }
            }else{
                $client->send("Nao é um array");
            }
        }
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, Exception $exception): void
    {
        $conn->close();
    }
}
