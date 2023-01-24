<?php

include_once "models/DatabaseVersion.php";
include_once "models/DatabaseLog.php";

class DatabaseController {
    static function update(){ 
        $fields['databaseVersion'] = isset($_REQUEST['databaseVersion']) ? $_REQUEST['databaseVersion'] : 1;
        
        $database_version = DatabaseVersion::get();

        if ($database_version){
            $database_version = DatabaseVersion::get()['databaseVersion'];
        }
        
        if ($fields['databaseVersion'] < $database_version){ 
            echo(json_encode(
                DatabaseLog::getAbove($fields['databaseVersion'])
            ));
        } else {  
            echo (json_encode(array()));
        } 
    }
}