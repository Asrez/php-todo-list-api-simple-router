<?php


namespace Controllers;


class HomeController
{

    function index(): void  // Just echo something
    {
        $data = json_decode(file_get_contents(__DIR__."/../dict.json"), true);
        
        if (json_last_error() === JSON_ERROR_NONE && is_array($data)){

            $result = ["status" => 200, "data" => $data];

        } else{
            $result = ["status" => 501, "data" => ["massage" => "Internal server error"]];
        }

        echo json_encode($result);
    }
}