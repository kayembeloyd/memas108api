<?php 

class Database {
    /*
    public static $servername = "localhost";
    public static $username = "id19693607_lkayembe";
    public static $password = "{&QU)vlSQ}q=qMs5";

    public static $DATABASE_NAME = "id19693607_mem106"; 
    */
    
    public static $servername = "localhost";
    public static $username = "root";
    public static $password = "";

    public static $DATABASE_NAME = "onlinememasdatabase";
    
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