<?php 

include_once "database/database.php";
include_once "models/TechnicalSpecification.php";

class Equipment { 
    public static function create($fields){
        $equipment_id = Database::execute_getting_last_id(
            "INSERT INTO " . Database::$DATABASE_NAME . ".equipmenttable
            (name, 
            assetTag, 
            departmentId, 
            make, 
            model, 
            serialNumber, 
            commissionDate, 
            lastMaintenanceDate, 
            nextMaintenanceDate, 
            statusOptionId, 
            uploaded)  
            VALUES (" 
            . "'" . $fields['name'] . "'," 
            . "'" . $fields['assetTag'] . "',"
            . $fields['departmentId'] . ","
            . "'" . $fields['make'] . "',"
            . "'" . $fields['model']. "',"
            . "'" . $fields['serialNumber'] . "',"
            . "'" . $fields['commissionDate'] . "',"
            . "'" . $fields['lastMaintenanceDate'] . "'," 
            . "'" . $fields['nextMaintenanceDate'] . "'," 
            . $fields['statusOptionId'] . "," 
            . 0 
            . ")"
        );

        $technical_specification_json = json_decode($fields['technicalSpecifications']);

        foreach ($technical_specification_json as $json_object) {
            $fields2 = array();

            $fields2['name'] = $json_object->name; 
            $fields2['value'] = $json_object->value; 
            $fields2['equipmentId'] = $equipment_id; 
            $fields2['uploaded'] = 0; 

            $technical_specification_id = TechnicalSpecification::create($fields2);
        } 

        return $equipment_id;
    }

    public static function update($fields){
        Database::execute("UPDATE " . Database::$DATABASE_NAME . ".equipmenttable SET " . 
            "name=" . "'" . $fields['name'] . "'," .
            "assetTag=" . "'" . $fields['assetTag'] . "'," .
            "departmentId=" . $fields['departmentId'] . "," .
            "make=" . "'" . $fields['make'] . "'," .
            "model=" . "'" . $fields['model'] . "'," .
            "serialNumber=" . "'" . $fields['serialNumber'] . "'," .
            "commissionDate=" . "'" . $fields['commissionDate'] . "'," .
            "lastMaintenanceDate=" . "'" . $fields['lastMaintenanceDate'] . "'," .
            "nextMaintenanceDate=" . "'" . $fields['nextMaintenanceDate'] . "'," .
            "statusOptionId=" . $fields['statusOptionId'] . "," .
            "uploaded=" . $fields['uploaded'] . " " . 
            "WHERE id=" . $fields['id']
        );

        $technical_specification_json = json_decode($fields['technicalSpecifications']);

        foreach ($technical_specification_json as $json_object) {
            $fields2 = array();

            $fields2['id'] = $json_object->id; 
            $fields2['name'] = $json_object->name; 
            $fields2['value'] = $json_object->value; 
            $fields2['equipmentId'] = $fields['id']; 
            $fields2['uploaded'] = 0; 

            $technical_specification_id = TechnicalSpecification::update($fields2);
        } 

        return $fields['id'];
    }
    
    public static function paginate($fields){
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".equipmenttable LIMIT " . $fields['size'] . " OFFSET " . ($fields['page'] - 1) * $fields['size']
        ));
    }

    public static function paginateSchedule($fields){ 
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".equipmenttable WHERE nextMaintenanceDate >= '". $fields['nowDate'] . "' ORDER BY nextMaintenanceDate ASC" . " LIMIT " . $fields['size'] . " OFFSET " . ($fields['page'] - 1) * $fields['size'] 
        ));
    }

    public static function paginateOverdueSchedule($fields){
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".equipmenttable WHERE nextMaintenanceDate < '". $fields['nowDate'] . "' ORDER BY nextMaintenanceDate ASC" . " LIMIT " . $fields['size'] . " OFFSET " . ($fields['page'] - 1) * $fields['size'] 
        ));
    }

    public static function get($fields){
        if (isset($fields['id'])){
            return self::modify_results(Database::execute(
                "SELECT * FROM " . Database::$DATABASE_NAME . ".equipmenttable WHERE id=" . $fields['id']
            ));
        } else if (isset($fields['assetTag'])){
            return self::modify_results(Database::execute(
                "SELECT * FROM " . Database::$DATABASE_NAME . ".equipmenttable WHERE assetTag ='" . $fields['assetTag'] . "'"
            ));
        }
    }

    private static function modify_results($sql_results){
        $object_array = array();
        
        if ($sql_results){
            while($object = mysqli_fetch_object($sql_results)){
                $modified_object = array();
                $modified_object['id'] = $object->id;
                $modified_object['name'] = $object->name;
                $modified_object['assetTag'] = $object->assetTag;
                $modified_object['departmentId'] = $object->departmentId;
                $modified_object['make'] = $object->make;
                $modified_object['model'] = $object->model;
                $modified_object['serialNumber'] = $object->serialNumber;
                $modified_object['commissionDate'] = $object->commissionDate;
                $modified_object['lastMaintenanceDate'] = $object->lastMaintenanceDate;
                $modified_object['nextMaintenanceDate'] = $object->nextMaintenanceDate;
                $modified_object['statusOptionId'] = $object->statusOptionId;
                $modified_object['uploaded'] = $object->uploaded; 
                array_push($object_array, $modified_object);
            }
        }

        return $object_array;
    }
}