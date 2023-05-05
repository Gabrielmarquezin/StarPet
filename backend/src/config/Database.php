<?php
namespace Boringue\Backend\config;

use \PDO;
use PDOException;

require_once './global.php';

class Database{
    private static $instancia;
    
    public static function conexao(){
        $host = getenv('HOST');
        $dbname = getenv('DBNAME');

        try {
            if(!isset(self::$instancia)){
                self::$instancia = new PDO("mysql:host=$host;dbname=$dbname", 'root', getenv('PASSWORD'), array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
                self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
           
            return self::$instancia;
            
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
