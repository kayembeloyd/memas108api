<?php

include_once "models/MaintenanceLog.php";

class MaintenanceLogsController {
    static function index(){
        $fields = array();

        $fields['size'] = isset($_REQUEST['size']) ? $_REQUEST['size'] : 5;
        $fields['page'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

        $maintenance_logs = MaintenanceLog::paginate($fields);

        for ($i=0; $i < count($maintenance_logs); $i++) { 
            $fields2 = array(); 
            $fields2['maintenanceLogId'] = $maintenance_logs[$i]['id'];
            $maintenance_logs[$i]['maintenanceLogData'] = MaintenanceLogData::all($fields2);

            $fields3 = array();
            $fields3['id'] = $maintenance_logs[$i]['equipmentId'];
            $maintenance_logs[$i]['equipment'] = Equipment::get($fields3);
            
            if (count($maintenance_logs[$i]['equipment']) > 0) 
                $maintenance_logs[$i]['equipment'] = $maintenance_logs[$i]['equipment'][0]; 
        } 

        echo json_encode($maintenance_logs);
    }

    static function create(){
        // Creating equipment
        $fields = array();

        $fields['equipmentId'] = isset($_POST['equipmentId']) ? $_POST['equipmentId'] : '';
        $fields['date'] = isset($_POST['date']) ? $_POST['date'] : '';
        $fields['doneByUserId'] = isset($_POST['doneByUserId']) ? $_POST['doneByUserId'] : '';
        $fields['type'] = isset($_POST['type']) ? $_POST['type'] : '';
        $fields['description'] = isset($_POST['description']) ? $_POST['description'] : '';
        $fields['uploaded'] = isset($_POST['uploaded']) ? $_POST['uploaded'] : '';

        $fields['maintenanceLogData'] = isset($_POST['maintenanceLogData']) ? $_POST['maintenanceLogData'] : '';
        
        $maintenance_log_id = MaintenanceLog::create($fields);

        // Logging
        $fields2 = array();
        
        $fields2['createdByUserId'] = 0;
        $fields2['createdAt'] = 'NOW()';
        $fields2['object'] = 'maintenanceLog';
        $fields2['objectId'] = $maintenance_log_id;
        $fields2['beforeUpdateDatabaseVersion'] = 123; // Real value replaced in the create function
        $fields2['statementExecuted'] = 'create';

        DatabaseLog::create($fields2);

        // Creating response
        $response = array();

        $response['status'] = 'success';
        $response['reason'] = 'successfully created maintenanance Log'; 

        echo (json_encode($response));
    }
}