<?php 

include_once "database/database.php";

class TechnicalSpecification { 
    public static function create($fields){
        $technical_specification_id = Database::execute_getting_last_id(
            "INSERT INTO " . Database::$DATABASE_NAME . ".technicalspecificationstable
            (name, 
            value,
            equipmentId,
            uploaded) 
            VALUES(" 
            . "'" . $fields['name'] . "',"  
            . "'" . $fields['value'] . "',"  
            . $fields['equipmentId'] . ","
            . 0   
            . ")"
        );

        return $technical_specification_id;
    }

    public static function update($fields){
        Database::execute("UPDATE " . Database::$DATABASE_NAME . ".technicalspecificationstable SET " . 
            "name=" . "'" . $fields['name'] . "'," .
            "value=" . "'" . $fields['value'] . "'," .
            "equipmentId=" . $fields['equipmentId'] . "," .
            "uploaded=" . $fields['uploaded'] . " " . 
            "WHERE id=" . $fields['id']
        );

        return $fields['id'];
    }

    public static function all($fields){
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".technicalspecificationstable WHERE equipmentId=" . $fields['equipmentId']
        ));
    }

    private static function modify_results($sql_results){
        $object_array = array();
        
        if ($sql_results){
            while($object = mysqli_fetch_object($sql_results)){
                $modified_object = array();
                $modified_object['id'] = $object->id;
                $modified_object['name'] = $object->name; 
                $modified_object['value'] = $object->value; 
                $modified_object['equipmentId'] = $object->equipmentId; 
                $modified_object['uploaded'] = $object->uploaded; 
                array_push($object_array, $modified_object);
            }
        }

        return $object_array;
    }
}