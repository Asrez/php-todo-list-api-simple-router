<?php


namespace Controllers;

class Route
{
    private $routes = [];


    function add(string $url, string $method, string $controller, string $action): void
    {
        $regex = '/\{([\w\-_]+)\}/i';

        $urlPattern = preg_replace_callback($regex, fn($matches) => "(?<$matches[1]>[\w\-_]+)/?", $url);

        
        $this->routes[] = [
            "urlPattern" => "#^$urlPattern$#",
            "method" => $method,
            "controller" => $controller,
            "action" => $action
        ];

    }

    function match(string $requestUrl, string $requestMethod): bool
    {
        
        foreach ($this->routes as $route){

            if ($route["method"] === $requestMethod){

                if (preg_match($route["urlPattern"], $requestUrl, $matches)){
                    $controller = $route["controller"];
                    $action = $route["action"];
                    unset($matches[0]);
                    
                    $this->callControlerAction($controller, $action, $matches);

                    return true;
                }
            }
        }
        
        $this->invalidRequest($requestUrl);
        return false;
    }

    private function callControlerAction(string $controller, string $action, array $params): void  // Just echo something
    {
        $controllerInstance = new $controller();

        if (method_exists($controllerInstance, $action)){
            call_user_func_array([$controllerInstance, $action], [$params]);
        } else{

            echo json_encode(["status" => 501, "data" => ["massage" => "Internal server error"]]);
        }
    }


    private function invalidRequest(string $route): void  // Just echo something
    {
        $response = [
            "error_code" => 404,
            "error_massage" => "Request not found",
            "Requested_routed" => $route
        ];

        http_response_code(404);

        echo json_encode($response);
    }
}