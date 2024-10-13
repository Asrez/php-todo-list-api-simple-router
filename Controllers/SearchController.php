<?php


namespace Controllers;


class SearchController
{

    function index($params)
    {

        $data = json_decode(file_get_contents("/home/max/absent/api/dict.json"), true);

        $word = strtolower($params["word"]);

        $result = [];

        foreach ($data as $query => $translate){

            if ($query == $word){
                $result = ["status" => 200, "data" => ["word" => $word, "translate" => $translate]];
                break;
            }
        }

        if (!$result) $result = ["status" => 404, "data" => ["massage" => "Word not found"]];

        print_r(json_encode($result));
    }
}