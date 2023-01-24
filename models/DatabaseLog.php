<?php 

include_once "database/database.php";
include_once "models/DatabaseVersion.php";

class DatabaseLog {
    public static function create($fields){
        DatabaseVersion::increment();
        
        $current_database_version = DatabaseVersion::get();
 
        $database_log_id = Database::execute_getting_last_id(
            "INSERT INTO " . Database::$DATABASE_NAME . ".databaselogstable
            (createdByUserId, 
            createdAt, 
            object, 
            objectId, 
            beforeUpdateDatabaseVersion, 
            statementExecuted)  
            VALUES (" 
            . $fields['createdByUserId'] . ","
            . $fields['createdAt'] . ","
            . "'" . $fields['object'] . "',"
            . $fields['objectId'] . ","
            . $current_database_version['databaseVersion'] . ','
            . "'" . $fields['statementExecuted'] . "'"
            . ")"
        ); 
        
        return $database_log_id;
    }

    public static function all(){
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".databaselogstable"
        ));
    }

    public static function getAbove($database_version){
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".databaselogstable WHERE beforeUpdateDatabaseVersion > " . $database_version
        ));
    }

    public static function get($fields){
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".databaselogstable WHERE id=" . $fields['id']
        ));
    }


    private static function modify_results($sql_results){
        $object_array = array();
        
        if ($sql_results){
            while($object = mysqli_fetch_object($sql_results)){
                $modified_object = array();
                $modified_object['id'] = $object->id;
                $modified_object['createdByUserId'] = $object->createdByUserId;
                $modified_object['createdAt'] = $object->createdAt;
                $modified_object['object'] = $object->object;
                $modified_object['objectId'] = $object->objectId;
                $modified_object['beforeUpdateDatabaseVersion'] = $object->beforeUpdateDatabaseVersion; 
                $modified_object['statementExecuted'] = $object->statementExecuted; 
                array_push($object_array, $modified_object);
            }
        }

        return $object_array;
    }
    
}