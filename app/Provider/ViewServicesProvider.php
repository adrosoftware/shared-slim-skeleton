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

use League\Plates\Engine;
use Psr\Container\ContainerInterface;

class ViewServicesProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container)
    {
        $viewConfigs = $container->get('app.settings')['view'];
        $view = new Engine($viewConfigs['path']);

        $container->set('view', $view);
    }
    
    public function boot(ContainerInterface $container)
    {
    }
}