<?php

class Connection
{
    public static $conn;

    public static function open($name)
    {
        if (file_exists("config/{$name}.ini"))
        {
            $db = parse_ini_file("config/{$name}.ini");
        }
        else
        {
            throw new Exception("Arquivo '$name' nao encontrado");
        }
        
        // l� as informa��es contidas no arquivo
        $user = isset($db['user']) ? $db['user'] : NULL;
        $pass = isset($db['pass']) ? $db['pass'] : NULL;
        $name = isset($db['name']) ? $db['name'] : NULL;
        $host = isset($db['host']) ? $db['host'] : NULL;
        $type = isset($db['type']) ? $db['type'] : NULL;
        $port = isset($db['port']) ? $db['port'] : NULL;
        
        // descobre qual o tipo (driver) de banco de dados a ser utilizado
        switch ($type)
        {
            case 'pgsql':
                $port = $port ? $port : '5432';
                $conn = new PDO("pgsql:dbname={$name}; user={$user}; password={$pass};
                        host=$host;port={$port}");
                break;
            case 'mysql':
                $port = $port ? $port : '3307';
                $conn = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
                break;
            case 'sqlite':
                $conn = new PDO("sqlite:{$name}");
                break;
            case 'ibase':
                $conn = new PDO("firebird:dbname={$name}", $user, $pass);
                break;
            case 'oci8':
                $conn = new PDO("oci:dbname={$name}", $user, $pass);
                break;
            case 'mssql':
                $conn = new PDO("mssql:host={$host},1433;dbname={$name}", $user, $pass);
                break;
        }
        // define para que o PDO lance exce��es na ocorr�ncia de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // retorna o objeto instanciado.
        self::$conn = $conn;
    }

    public static function select($sql){
        return self::$conn->query($sql);
    }
    
    public static function exec($sql){
        return self::$conn->exec($sql);
    }
    
    public static function close(){
        self::$conn=null;
    }
}
