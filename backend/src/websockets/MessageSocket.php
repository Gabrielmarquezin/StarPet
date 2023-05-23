<?php

require __DIR__. '../../../vendor/autoload.php';

use Boringue\Backend\websockets\ChatServer;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new ChatServer()
            )
        ),
        3001
    );

    $server->run();