<?php
include_once "models/Equipment.php";

class MaintenanceScheduleController {
    static function index(){
        $fields = array();

        $fields['size'] = isset($_REQUEST['size']) ? $_REQUEST['size'] : 5;
        $fields['page'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $fields['nowDate'] = isset($_REQUEST['nowDate']) ? $_REQUEST['nowDate']: '2023-01-28';
 
        $equipment = Equipment::paginateSchedule($fields);

        for ($i=0; $i < count($equipment); $i++) { 
            $fields2 = array(); 
            $fields2['equipmentId'] = $equipment[$i]['id'];
            $equipment[$i]['technicalSpecifications'] = TechnicalSpecification::all($fields2);
        } 

        echo json_encode($equipment);
    }
}