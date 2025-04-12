<?php

    /*
    -   PHP API
    -   developer : https://mayankdevil.github.io/MayankDevil
    -   PHP : ./api/single-data.php
    -   fetch single data from database
    */

    // header("Content-Type: application/json");

    include('./config.php');

    // $data = json_decode(file_get_contents("php://input"), true);

    $employee_id = $_REQUEST['employee_id'];

    $query = "select * from employee where id =" . $employee_id;

    $result = mysqli_query($connect, $query) or die('query unexecuted!');

    if (mysqli_num_rows($result) > 0)
    {
        $output_data = mysqli_fetch_assoc($result);
        
        echo json_encode(array(
            'status' => 1,
            'message' => 'singale data fetch successfully!',
            'data' => $output_data
        ),JSON_PRETTY_PRINT);
    }
    else
    {
        echo json_encode(array(
            'status' => 0,
            'message' => 'singale data fetch failed!',
            'data' => null
        ), JSON_PRETTY_PRINT);
    }
    mysqli_close($connect);
    
?>