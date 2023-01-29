<?php 

include_once "route.php";

include_once "controllers/EquipmentController.php";
include_once "controllers/MaintenanceLogsController.php";
include_once "controllers/MaintenanceScheduleController.php";
include_once "controllers/DatabaseController.php";

/**
 * -----------------------------------------------
 * PHP Route Things
 * -----------------------------------------------
 */

function cors() {
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
        exit(0);
    }
}

cors();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        Route::add('/', function(){ echo('home'); }); 
        Route::add('/equipment', function() { EquipmentController::index(); });
        Route::add('/equipment/.+', function($asset_tag) { EquipmentController::show($asset_tag); });
        Route::add('/maintenance-logs', function() { MaintenanceLogsController::index(); });
        Route::add('/maintenance-schedule', function() { MaintenanceScheduleController::index(); });
        Route::add('/database/update', function() { DatabaseController::update(); });
        // Route::add('/departments', function() { DepartmentsController::index(); });          // TO-DO
        // Route::add('/departments/.+', function($id) { DepartmentsController::show($id); });  // TO-DO
        break;
    case 'POST':
        Route::add('/equipment', function() { EquipmentController::create(); }); 
        Route::add('/equipment/update', function() { EquipmentController::update(); }); 
        Route::add('/maintenance-logs', function() { MaintenanceLogsController::create(); });
        // Route::add('/departments', function() { DepartmentsController::create(); });         // TO-DO
        // Route::add('/departments/.+/delete', function() {DepartmentsController::delete(); });// TO-DO
        break;
    default:
        echo 'unsupported method';
}

//method for execution routes    
Route::submit();