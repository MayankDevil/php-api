<?php

    /*
    -   PHP API
    -   developer : https://mayankdevil.github.io/MayankDevil
    -   PHP : /api/insert-data.php
    -   insert data from database
    */

    // header("Content-Type:application/json");

    include("./config.php");

    // $data = json_decode(file_get_contents("php://input"), true);

    $id = $_REQUEST["id"];
    $first_name = $_REQUEST["first_name"];
    $last_name = $_REQUEST["last_name"];
    $gender = $_REQUEST["gender"];

    $query = "insert into employee values($id,'$first_name','$last_name','$gender')";
    
    if (mysqli_query($connect,$query))
    {                
        echo json_encode(array(
            'status' => 1,
            'message' => 'data inserted successfully!',
            'data' => mysqli_affected_rows($connect)
        ), JSON_PRETTY_PRINT);
    }
    else
    {
        echo json_encode(array(
            'status' => 0,
            'message' => 'data inserted failed!',
            'data' => null
        ), JSON_PRETTY_PRINT);
    }
    mysqli_close($connect);

?>