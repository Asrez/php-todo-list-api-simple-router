<?php


namespace Controllers;


class HomeController
{

    function index(): void  // Just echo something
    {
        $response = [
            "status_code" => 200,
            "data" => ["massage" => "Welcome"]
        ];

        $response = json_encode($response);

        echo $response;
    }
}