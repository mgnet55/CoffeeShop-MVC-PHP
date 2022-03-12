<?php

namespace PhpMvc\Http;

use PhpMvc\View\View;

class Route
{
    public static array $routes = [];
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public static function group(){

    }



    public static function GET($route, callable|array|string $action): void
    {
        $route = trim($route, "/");
        self::$routes['GET'][$route] = $action;
    }

    public static function POST($route, callable|array|string $action): void
    {
        $route = trim($route, "/");
        self::$routes['POST'][$route] = $action;
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        $action = self::$routes[$method][$path] ?? false;
        //$data = $this->request->data(); //to be sent as arguments

        if (!array_key_exists($path,self::$routes[$method])) {
            $this->response->setStatusCode(404);
            return View::makeError('404');
        }

        if (is_callable($action)) {
            call_user_func_array($action, []);
        }

        if (is_array($action)) {
            call_user_func_array([new $action[0], $action[1]], []);
        }
        /*if (is_string($action)) {
            $action = explode('@', $action);
            call_user_func_array([new $action[0], $action[1]], []);
        }*/
    }
}