<?php 

include_once "route.php";

include_once "controllers/EquipmentsController.php";
include_once "controllers/MaintenanceLogsController.php";
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
        Route::add('/equipment', function() { EquipmentsController::index(); });
        Route::add('/maintenance-logs', function() { MaintenanceLogsController::index(); });
        Route::add('/database/update', function() { DatabaseController::update(); });
        break;
    case 'POST':
        Route::add('/equipment', function() { EquipmentsController::create(); }); 
        Route::add('/equipment/update', function() { EquipmentsController::update(); }); 
        Route::add('/maintenance-logs', function() { MaintenanceLogsController::create(); });
        break;
    default:
        echo 'unsupported method';
}

//method for execution routes    
Route::submit();