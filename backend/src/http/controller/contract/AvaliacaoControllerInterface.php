<?php
namespace Boringue\Backend\http\controller\contract;

interface AvaliacaoControllerInterface{
    public function addMessages();

    public function getMessages();
    public function getMessagesPet();
    public function getMessagesPetAdocao();
    
    public function updateMessage();
    public function updateMessagePet();
    public function updateMessageAdocao();

    public function deleteMessage();
    public function deleteMessagePet();
    public function deleteMessageAdocao();

    
}