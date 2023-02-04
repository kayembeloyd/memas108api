<?php
include_once "models/User.php";

class UsersController {
    static function create(){
        // Checking username
        $user = User::show(self::fields());
        $response = array();

        if (count($user) <= 0){
            // Creating user
            $user_id = User::create(self::fields());

            // Creating response
            $response['status'] = 'success';
            $response['reason'] = 'successfully created user'; 
        } else {
            $response['status'] = 'fail';
            $response['reason'] = 'username already exists';
        }
        
        echo (json_encode($response));
    }

    static function login(){
        $fields = self::fields();

        $user = User::show($fields);
        $response = array();

        $fields['password'] = isset($_POST['password']) ? $_POST['password'] : ''; 

        if (count($user) > 0 && password_verify($fields['password'], $user[0]['password'])){
            $response['status'] = 'success';
            $response['reason'] = 'log in successful';
            $response['user'] = $user[0];
        } else {
            $response['status'] = 'fail';
            $response['reason'] = 'wrong password or username';
        }

        echo (json_encode($response));
    }

    private static function fields(){
        $fields = array();
        
        $fields['id'] = isset($_POST['id']) ? $_POST['id'] : 0;
        $fields['username'] = isset($_POST['username']) ? $_POST['username'] : '';
        $fields['password'] = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
        $fields['avatarId'] = isset($_POST['avatarId']) ? $_POST['avatarId'] : '';
        $fields['name'] = isset($_POST['name']) ? $_POST['name'] : '';
        $fields['position'] = isset($_POST['position']) ? $_POST['position'] : '';
        
        return $fields;
    }
}