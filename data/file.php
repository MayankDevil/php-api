<?php
    /*
    -   JSON file database (Application Programming Interface) api
    -   developed : https://mayankdevil.github.io/MayankDevil
    */

    header('Content-Type: application/json');   # set header

    # read POST and decode into associative array with generted timestamp

    $fetch_data = file_get_contents("php://input");

    $data = json_decode($fetch_data, true);

    if (!is_array($data)) 
    {
        echo json_encode(array(
            'status' => 0,
            'message' => 'invalid data format !'
        ), JSON_PRETTY_PRINT);

        exit;
    }

    /* is secure function admin validation */

    function isSecure($data) 
    {
        $valid = [
            'mayank' => password_hash('devil', PASSWORD_DEFAULT),
            'user'   => password_hash('pass', PASSWORD_DEFAULT)
        ];

        $username = filter_var($data['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($data['password'], FILTER_SANITIZE_STRING);

        if (!isset($username) || !isset($password)) 
        {
            return 0;
        }
        if (isset($valid[strtolower($username)])) 
        {
            if (password_verify($password, $valid[$username])) 
            {
                return 1;
            }
        }
        return 0;
    }

    # if data is not secure exit script

    if (!isSecure($data))
    {
        echo json_encode(array(
            'status' => 0,
            'message' => 'access unvalid !'
        ), JSON_PRETTY_PRINT);

        exit;
    }

    /* data store function unset return data */
    
    function dataStore($data)
    {        
        unset($data['username'], $data['password']);

        return $data;
    }
    
    $time = "data-" . date('d-m-Y-H-i-s');

    $new_data = [
        $time => dataStore($data)
    ];

    $file_name = "database.json";   // data base json file name

    if (file_exists($file_name) && filesize($file_name) !== 0) 
    {
        $file_data = file_get_contents($file_name);

        $associative_data = json_decode($file_data, true);
    }

    # append data and encode into JSON

    $associative_data[] = $new_data;

    $new_json_data = json_encode($associative_data, JSON_PRETTY_PRINT);

    if (file_put_contents($file_name, $new_json_data)) 
    {
        echo json_encode(array(
            'status' => 1,
            'message' => 'Database updated successfully! :)'
        ), JSON_PRETTY_PRINT);
    } 
    else 
    {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Database not updated! :('
        ), JSON_PRETTY_PRINT);
    }
    
?>