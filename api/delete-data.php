<?php

    /*
    -   PHP API
    -   developer : https://mayankdevil.github.io/MayankDevil
    -   PHP : ./api/delete-data.php
    -   delete data from database
    */

    // header("Content-Type:application/json");

    include("config.php");

    $delete_id = $_POST['deleteId'];

    $query = "Delete from employee where id=". $delete_id;

    if (mysqli_query($connect, $query))
    {                
        echo json_encode(array(
            'status' => 1,
            'message' => 'data deleted successfully!',
            'data' => mysqli_affected_rows($connect)
        ), JSON_PRETTY_PRINT);
    }
    else
    {
        echo json_encode(array(
            'status' => 0,
            'message' => 'data deleted failed!',
            'data' => null
        ), JSON_PRETTY_PRINT);
    }
    mysqli_close($connect);

?>