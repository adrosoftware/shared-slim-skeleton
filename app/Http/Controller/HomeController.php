<?php

namespace App\Http\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        $content = view()->render('home', ['name' => 'Adro']);;

        return $response->getBody()->write($content);
    }

    public function contact(Request $request, Response $response)
    {
        $content = view()->render('home', ['name' => 'C']);;

        return $response->getBody()->write($content);
    }
}
