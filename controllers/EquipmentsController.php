<?php

include_once "models/Equipment.php";
include_once "models/DatabaseLog.php";

class EquipmentsController {
    static function index(){
        $fields = array();

        $fields['size'] = isset($_REQUEST['size']) ? $_REQUEST['size'] : 5;
        $fields['page'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

        $equipment = Equipment::paginate($fields);

        for ($i=0; $i < count($equipment); $i++) { 
            $fields2 = array(); 
            $fields2['equipmentId'] = $equipment[$i]['id'];
            $equipment[$i]['technicalSpecifications'] = TechnicalSpecification::all($fields2);
        } 

        echo json_encode($equipment);
    }
  
    static function create(){
        // Creating equipment
        $equipment_id = Equipment::create(self::fields());

        // Logging
        $fields2 = array();
        
        $fields2['createdByUserId'] = 0;
        $fields2['createdAt'] = 'NOW()';
        $fields2['object'] = 'equipment';
        $fields2['objectId'] = $equipment_id;
        $fields2['beforeUpdateDatabaseVersion'] = 123; // Real value replaced in the create function
        $fields2['statementExecuted'] = 'create';

        DatabaseLog::create($fields2);
 
        // Creating response
        $response = array();

        $response['status'] = 'success';
        $response['reason'] = 'successfully created equipment'; 

        echo (json_encode($response));
    }

    public static function update(){
        $equipment_id = Equipment::update(self::fields());
     
        // Logging
        $fields2 = array();
        
        $fields2['createdByUserId'] = 0;
        $fields2['createdAt'] = 'NOW()';
        $fields2['object'] = 'equipment';
        $fields2['objectId'] = $equipment_id;
        $fields2['beforeUpdateDatabaseVersion'] = 123; // Real value replaced in the create function
        $fields2['statementExecuted'] = 'update';

        DatabaseLog::create($fields2);
 
        // Creating response
        $response = array();

        $response['status'] = 'success';
        $response['reason'] = 'successfully updated equipment'; 

        echo (json_encode($response));
    }

    private static function fields(){
        $fields = array();
        
        $fields['id'] = isset($_POST['id']) ? $_POST['id'] : 0;
        $fields['name'] = isset($_POST['name']) ? $_POST['name'] : '';
        $fields['assetTag'] = isset($_POST['assetTag']) ? $_POST['assetTag'] : '';
        $fields['departmentId'] = isset($_POST['departmentId']) ? $_POST['departmentId'] : '';
        $fields['make'] = isset($_POST['make']) ? $_POST['make'] : '';
        $fields['model'] = isset($_POST['model']) ? $_POST['model'] : '';
        $fields['serialNumber'] = isset($_POST['serialNumber']) ? $_POST['serialNumber'] : '';
        $fields['commissionDate'] = isset($_POST['commissionDate']) ? $_POST['commissionDate'] : '';
        $fields['lastMaintenanceDate'] = isset($_POST['lastMaintenanceDate']) ? $_POST['lastMaintenanceDate'] : '';
        $fields['nextMaintenanceDate'] = isset($_POST['nextMaintenanceDate']) ? $_POST['nextMaintenanceDate'] : '';
        $fields['statusOptionId'] = isset($_POST['statusOptionId']) ? $_POST['statusOptionId'] : '';
        $fields['uploaded'] = isset($_POST['uploaded']) ? $_POST['uploaded'] : '';

        $fields['technicalSpecifications'] = isset($_POST['technicalSpecifications']) ? $_POST['technicalSpecifications'] : '';
        
        return $fields;
    }
}