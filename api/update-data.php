<?php

    /*
    -   PHP API
    -   developer : https://mayankdevil.github.io/MayankDevil
    -   PHP : /api/update-data.php
    -   update data from database
    */

    // header("Content-Type:application/json");

    include("./config.php");

    $id = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $gender = $_POST["gender"];

    $query = "update employee set fname='$first_name', lname='$last_name', gender='$gender' where id='$id' ";
    
    if (mysqli_query($connect,$query))
    {                
        echo json_encode(array(
            'status' => 1,
            'message' => 'data updated successfully!',
            'data' => mysqli_affected_rows($connect)
        ), JSON_PRETTY_PRINT);
    }
    else
    {
        echo json_encode(array(
            'status' => 0,
            'message' => 'data updated failed!',
            'data' => null
        ), JSON_PRETTY_PRINT);
    }
    mysqli_close($connect);

?>