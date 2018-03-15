<?php

    require(__DIR__ . "/../includes/config.php");

 
    if (empty($_GET["geo"]))
    {
        http_response_code(400);
        exit;
    }


    $articles = lookup($_GET["geo"]);


    header("Content-type: application/json");
    print(json_encode($articles, JSON_PRETTY_PRINT));

?>