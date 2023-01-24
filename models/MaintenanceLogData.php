<?php 

class MaintenanceLogData { 
    public static function create($fields){
        $maintenance_log_data_id = Database::execute_getting_last_id(
            "INSERT INTO " . Database::$DATABASE_NAME . ".maintenancelogdatatable
            (name, 
            value,
            maintenanceLogId,
            uploaded) 
            VALUES(" 
            . "'" . $fields['name'] . "',"  
            . "'" . $fields['value'] . "',"  
            . $fields['maintenanceLogId'] . ","
            . 0   
            . ")"
        );

        return $maintenance_log_data_id;
    }

    public static function all($fields){
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".maintenancelogdatatable WHERE maintenanceLogId=" . $fields['maintenanceLogId']
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
                $modified_object['maintenanceLogId'] = $object->maintenanceLogId; 
                $modified_object['uploaded'] = $object->uploaded; 
                array_push($object_array, $modified_object);
            }
        }

        return $object_array;
    }
}