<?php

namespace Boringue\Backend\routes\framework;

class Middleware{
    private $action = [];
    private $middlewareBefore = [];
    private $middlewareAfter = [];

    public function __construct(array $action)
    {
        $this->action = $action;
    }

    public function before($middleware)
    {
        $this->middlewareBefore[] = $middleware;
        return $this;
    }

    public function after($middleware)
    {
        $this->middlewareAfter[] = $middleware;
        return $this;
    }

    public function getData(){

        return[
            'action' => $this->action,
            'before' => $this->middlewareBefore,
            'after'  => $this->middlewareAfter
        ];
    }
}