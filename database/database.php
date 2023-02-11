<?php 

class Database {
    public static $servername = "localhost";
    public static $username = "id19693607_kayembeloyd";
    public static $password = 'cL}$xmA0bnP4&xz#';
    public static $DATABASE_NAME = "id19693607_memas107";
    
    public static function check_connection(){
        $conn = new mysqli(self::$servername, self::$username, self::$password);
        
        if ($conn->connect_error) {
            return ($conn->connect_error);
        }

        $conn->close();

        return ('connected');
    }

    public static function execute($sql_statement){
        $conn = new mysqli(self::$servername, self::$username, self::$password);
        
        if ($conn->connect_error) {
            return ($conn->connect_error);
        }

        $results = $conn->query($sql_statement);

        $conn->close();

        return $results;
    }

    public static function execute_getting_last_id($sql_statement){
        $conn = new mysqli(self::$servername, self::$username, self::$password);
        
        if ($conn->connect_error) {
            return ($conn->connect_error);
        }

        $results = $conn->query($sql_statement);

        $last_id = $conn->insert_id;

        $conn->close();

        return $last_id;
    }
}