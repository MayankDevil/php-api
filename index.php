<!DOCTYPE html>
<!--
-   php-api
-   learn PHP Application Programming Interface fetch with Asynchronous JavaScript and XML using JQuery 
-   developed by https://mayankdevil.github.io/MayankDevil
-   PHP : /index.php
-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> test </title>
    <!--
        -----------------
        | bootstrap css |
        -----------------
    -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    

</head>

<body>

    <!-- heading -->
    <div class="bg-dark text-light p-1">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="h6"> learn PHP Application Programing Interface fetch Asynchronus JavaScript XML by JQuery or Bootstrap </div>
            <a href="https://mayankdevil.github.io/MayankDevil" class="btn btn-outline-light btn-sm" title="developer by Mayank"> Mayank </a>
        </div>
    </div>

    <!-- container -->
    <div class="container">

        <!-- ( alert box ) -->
        <div class="m-2" id="alertBox"></div>
        
        <!-- ( insert form ) -->
        <div class="w-75 mx-auto border rounded my-3 p-3">

            <form class="row align-items-center" id="insertForm">

                <div class="">
                    <div class="text-muted p-2"> enter employee id </div>
                    <input type="text" class="form-control" id="id"/>
                </div>
                
                <div class="">
                    <div class="text-muted p-2"> enter first name </div>
                    <input type="text" class="form-control" id="first_name">
                </div>
                
                <div class="">
                    <div class="text-muted p-2"> enter last name </div>
                    <input type="text" class="form-control" id="last_name">
                </div>
                
                <div class="row px-4">
                    <div class="col-12 text-muted p-2"> select gender </div>
                    <div class="p-2">
                        <input class="form-check-input gender" type="radio" value="F" name="gender" id="gender1" />
                        <label class="form-check-label" for="gender1"> Female </label>
                    </div>
                    <div class="p-2">
                        <input class="form-check-input gender" type="radio" value="M" name="gender" id="gender2" />
                        <label class="form-check-label" for="gender2"> Male </label>
                    </div>
                    <div class="p-2">
                        <input class="form-check-input gender" type="radio" value="T" name="gender" id="gender3" />
                        <label class="form-check-label" for="gender3"> TransGender </label>
                    </div>                        
                </div>
                
                <div class="px-3 text-end">

                    <input type="submit" value="insert data" class="btn btn-outline-dark btn-sm" id="insertButton" />
                    <input type="submit" value="updateata" class="btn btn-outline-dark btn-sm" id="updateButton">

                </div>
                
            </form>
            
        </div>
        
        <!-- ( output container ) -->
        <div id="output_result"></div>
            
    </div>
    
    <!--
        ----------------
        | bootstrap js |
        ----------------
    -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <script src="assets/bootstrap.bundle.min.js"></script>
    <!--
        -------------
        | jquery js |
        -------------
    -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
    <script src="assets/jquery.min.js"></script>
    <!--
        ----------
        | script |
        ----------
    -->
    <script>

        $(document).ready(function () {
            
            let url = "<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . "/"; ?>"

            console.log(`server : ${url}`)

            $.ajax({
                url: 'data/file.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    username: 'user',
                    password: 'pass',
                    data : 'new data update'
                }),
                success: function(response) {
                    console.log(response);
                },
                error: function(err) {
                    console.error("Request failed", err);
                }
            });

        })

    </script>
    <script src="js/script.js"></script>
    

</body>

</html>