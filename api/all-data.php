<?php

    /*
    -   PHP API
    -   developer : https://mayankdevil.github.io/MayankDevil
    -   PHP : ./api/all-data.php
    -   fetch all data from database
    */

    // header("Content-Type:application/json");

    include('./config.php');

    $query = "select * from employee";

    $result = mysqli_query($connect,$query) or die('query unexecuted!');

    if (mysqli_num_rows($result) > 0)
    {
        $output_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        echo  json_encode(array(
            'status' => '1',
            'message' => 'data fetch successfully',
            'data' => $output_data
        ),JSON_PRETTY_PRINT);
    }   
    else
    {
        echo  json_encode(array(
            'status' => '0',
            'message' => 'data fetch failed',
            'data' => null
        ),JSON_PRETTY_PRINT);
    }
    mysqli_close($connect);
    
?>