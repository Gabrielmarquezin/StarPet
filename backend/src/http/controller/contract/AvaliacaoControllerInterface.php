<?php
namespace Boringue\Backend\http\controller\contract;

interface AvaliacaoControllerInterface{
    public function addMessages();
    public function getMessages();
    public function updateMessage();
    public function deleteMessage();
}