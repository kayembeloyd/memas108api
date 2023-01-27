<?php 

include_once 'models/MaintenanceLogData.php';

class MaintenanceLog { 
    public static function create($fields){
        $maintenance_log_id = Database::execute_getting_last_id(
            "INSERT INTO " . Database::$DATABASE_NAME . ".maintenancelogstable
            (equipmentId, 
            date,
            doneByUserId,
            type,
            description,
            uploaded) 
            VALUES(" 
            . $fields['equipmentId'] . ","  
            . "'" . $fields['date'] . "',"  
            . $fields['doneByUserId'] . ","
            . "'" . $fields['type'] . "',"  
            . "'" . $fields['description'] . "',"  
            . 0   
            . ")"
        );

        $maintenance_log_data_json = json_decode($fields['maintenanceLogData']);

        foreach ($maintenance_log_data_json as $json_object) {
            $fields2 = array();

            $fields2['name'] = $json_object->name;  
            $fields2['value'] = $json_object->value;  
            $fields2['maintenanceLogId'] = $maintenance_log_id; 
            $fields2['uploaded'] = 0; 

            $maintenance_log_data_id = MaintenanceLogData::create($fields2);
        } 

        return $maintenance_log_id;
    }

    public static function paginate($fields){
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".maintenancelogstable LIMIT " . $fields['size'] . " OFFSET " . ($fields['page'] - 1) * $fields['size']
        ));
    }

    private static function modify_results($sql_results){
        $object_array = array();
        
        if ($sql_results){
            while($object = mysqli_fetch_object($sql_results)){
                $modified_object = array();
                $modified_object['id'] = $object->id;
                $modified_object['equipmentId'] = $object->equipmentId;
                $modified_object['date'] = $object->date;
                $modified_object['doneByUserId'] = $object->doneByUserId;
                $modified_object['type'] = $object->type;
                $modified_object['description'] = $object->description;
                $modified_object['uploaded'] = $object->uploaded; 
                array_push($object_array, $modified_object);
            }
        }

        return $object_array;
    }
}