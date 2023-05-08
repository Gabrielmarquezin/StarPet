<?php
namespace Boringue\Backend\file;

class RenderFile{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function Render()
    {
        $arquivo = $this->file;
        if($arquivo['error'] == 0) {
            // Abre o arquivo em modo binário
            $handle = fopen($arquivo['tmp_name'], 'rb');

            // Converte o arquivo em um formato adequado para salvar no banco de dados
            $conteudo = fread($handle, filesize($arquivo['tmp_name']));

            // Fecha o arquivo
            fclose($handle);

            return $conteudo;
        }
    }
}