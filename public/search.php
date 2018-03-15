<?php

    require(__DIR__ . "/../includes/config.php");

    
    $places = [];

   
    $places = CS50::query("SELECT * FROM places WHERE MATCH(postal_code, place_name, admin_name1, admin_code1) AGAINST (?)", $_GET["geo"]);

   
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>