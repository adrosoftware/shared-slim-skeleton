<?php
/**
 * Shared Slim Skeleton.
 *
 * @link      https://github.com/adrosoftware/shared-slim-skeleton
 *
 * @copyright Copyright (c) 2018 Adro Rocker
 * @author    Adro Rocker <mes@adro.rocks>
 */

require 'vendor/autoload.php';

use App\Application;

(new Application(__DIR__))->run();
