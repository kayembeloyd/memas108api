<?php 

include_once "database/database.php";

class DatabaseVersion {
    public static function increment(){
        $database_version = self::get(); 

        if ($database_version){
            Database::execute(
                "UPDATE " . Database::$DATABASE_NAME . ".databaseversiontable SET databaseVersion = " . ($database_version['databaseVersion'] + 1) . " WHERE id = 1"
            );

            return $database_version['id'];
        } else {
            $database_version_id = Database::execute_getting_last_id(
                "INSERT INTO " . Database::$DATABASE_NAME . ".databaseversiontable
                (databaseVersion, 
                uploaded)  
                VALUES (" 
                . 1 . ","
                . 0 
                . ")"
            );

            return $database_version_id;
        }
        
    }

    public static function get(){
        $database_version = self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".databaseversiontable WHERE id = 1"
        ));

        if (count($database_version) > 0) return $database_version[0];

        return null;
    }

    private static function modify_results($sql_results){
        $object_array = array();
        
        if ($sql_results){
            while($object = mysqli_fetch_object($sql_results)){
                $modified_object = array();
                $modified_object['id'] = $object->id;
                $modified_object['databaseVersion'] = $object->databaseVersion;
                $modified_object['uploaded'] = $object->uploaded;
                array_push($object_array, $modified_object);
            }
        }

        return $object_array;
    }
}