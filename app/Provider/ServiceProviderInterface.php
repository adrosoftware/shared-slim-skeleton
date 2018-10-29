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

use Psr\Container\ContainerInterface;

interface ServiceProviderInterface
{
    public function register(ContainerInterface $container);

    public function boot(ContainerInterface $container);
}
