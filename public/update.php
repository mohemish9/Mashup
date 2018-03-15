<?php

    require(__DIR__ . "/../includes/config.php");


    if (!isset($_GET["sw"], $_GET["ne"]))
    {
        http_response_code(400);
        exit;
    }

    if (!preg_match("/^-?\d+(?:\.\d+)?,-?\d+(?:\.\d+)?$/", $_GET["sw"]) ||
        !preg_match("/^-?\d+(?:\.\d+)?,-?\d+(?:\.\d+)?$/", $_GET["ne"]))
    {
        http_response_code(400);
        exit;
    }


    list($sw_lat, $sw_lng) = explode(",", $_GET["sw"]);

  
    list($ne_lat, $ne_lng) = explode(",", $_GET["ne"]);

 
    if ($sw_lng <= $ne_lng)
    {
        
        $rows = CS50::query("SELECT * FROM places WHERE ? <= latitude AND latitude <= ? AND (? <= longitude AND longitude <= ?) GROUP BY country_code, place_name, admin_code1 ORDER BY RAND()", $sw_lat, $ne_lat, $sw_lng, $ne_lng);
    }
    else
    {
        
        $rows = CS50::query("SELECT * FROM places WHERE ? <= latitude AND latitude <= ? AND (? <= longitude OR longitude <= ?) GROUP_BY country_code, place_name, admin_code1 ORDER BY RAND()", $sw_lat, $ne_lat, $sw_lng, $ne_lng);
    }

    
    header("Content-type: application/json");
    print(json_encode($rows, JSON_PRETTY_PRINT));

?>