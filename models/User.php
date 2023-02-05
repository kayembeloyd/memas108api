<?php

class User { 
    public static function create($fields){ 
        return Database::execute_getting_last_id(
            "INSERT INTO " . Database::$DATABASE_NAME . ".userstable
            (username, 
            password, 
            avatarId,
            name,
            position)  
            VALUES (" 
            . "'" . $fields['username'] . "'," 
            . "'" . $fields['password'] . "',"
            . $fields['avatarId'] . ","
            . "'" . $fields['name'] . "',"
            . "'" . $fields['position']. "'"
            . ")"
        );
    }

    public static function show($fields){
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".userstable WHERE username='" . $fields['username'] . "'"
        ), true);
    }

    public static function get($fields){
        return self::modify_results(Database::execute(
            "SELECT * FROM " . Database::$DATABASE_NAME . ".userstable WHERE id=" . $fields['id']
        ), false);
    }

    private static function modify_results($sql_results, $show_password){
        $object_array = array();
        
        if ($sql_results){
            while($object = mysqli_fetch_object($sql_results)){
                $modified_object = array();
                $modified_object['id'] = $object->id;
                $modified_object['username'] = $object->username;
                $modified_object['avatarId'] = $object->avatarId;
                $modified_object['name'] = $object->name;
                $modified_object['position'] = $object->position;
                if ($show_password) $modified_object['password'] = $object->password;
                array_push($object_array, $modified_object);
            }
        }

        return $object_array;
    }
}