<?php
/**
 * Shared Slim Skeleton.
 *
 * @link      https://github.com/adrosoftware/shared-slim-skeleton
 *
 * @copyright Copyright (c) 2018 Adro Rocker
 * @author    Adro Rocker <mes@adro.rocks>
 */
namespace App\Provider;

use App\Http\Controller;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class RouteServicesProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container)
    {
        $app = $container->get('app');

        $slim = $app->slim();

        $slim->get('/', action_path(Controller\HomeController::class, 'index'))->setName('home');
    }
    
    public function boot(ContainerInterface $container)
    {
    }
}