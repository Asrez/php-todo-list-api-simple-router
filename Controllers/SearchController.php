<?php


namespace Controllers;


class SearchController
{

    function index(array $params): void  // Just echo something
    {

        $data = json_decode(file_get_contents(__DIR__."/../dict.json"), true);
        
        if (json_last_error() === JSON_ERROR_NONE && is_array($data)){
            
            $word = strtolower($params["word"]);

            foreach ($data as $query => $translate){

                if ($query === $word){
                    $result = ["status" => 200, "data" => ["word" => $word, "translate" => $translate]];
                    break;
                }
            }

            if (!$result) $result = ["status" => 504, "data" => ["word" => $word, "massage" => "Word not found"]];

        } else{
            $result = ["status" => 501, "data" => ["massage" => "Internal server error"]];
        }

        echo json_encode($result);
    }
}