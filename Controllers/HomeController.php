<?php


namespace Controllers;


class HomeController
{

    function index()
    {
        $response = [
            "status_code" => 200,
            "massage" => "Welcome"
        ];

        $response = json_encode($response);

        echo $response;
    }
}