<?php
/**
 * Shared Slim Skeleton.
 *
 * @link      https://github.com/adrosoftware/shared-slim-skeleton
 *
 * @copyright Copyright (c) 2018 Adro Rocker
 * @author    Adro Rocker <mes@adro.rocks>
 */
namespace App;

use BadMethodCallException;
use Dotenv\Dotenv;
use App\Provider\ViewServicesProvider;
use App\Provider\RouteServicesProvider;
use App\Provider\ServiceProviderInterface;
use DI\Bridge\Slim\App as DiApp;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Application
{
    protected $providers = [];
    protected $container;
    protected $configs = [];
    public $version = '0.1.0';
    protected $booted = false;

    protected static $instance;

    public static function getInstance()
    {
        return static::$instance;
    }

    public function __construct($root)
    {
        $this->base = $root . DIRECTORY_SEPARATOR . 'app';
        $this->root = $root;

        static::$instance = $this;

        $this->bootstrap();
        $this->registerDefaultServices();
    }

    /**
     * Bootstrap the application.
     *
     * @return void
     */
    protected function bootstrap()
    {
        $this->createConstants();
        $dotenv = new Dotenv($this->root);
        $dotenv->overload();
        $this->setConfig();
        $this->slim = $this->createApp();
        $this->container = $this->slim->getContainer();
        $this->container->set('app', $this);
        $this->container->set('app.settings', $this->configs);
    }

    protected function createApp()
    {
        $settings = [
            'settings' => $this->configs['slim'],
        ];
        
        return new DiApp($settings);
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function slim()
    {
        return $this->slim;
    }

    public function createConstants()
    {
        define('APP_PATH', realpath($this->root . '/app/'));
        define('PUBLIC_PATH', realpath($this->root));
        define('VIEWS_PATH', realpath($this->root . '/resources/views/'));
        define('STORAGE_PATH', realpath($this->base . '/storage/'));
        define('VERSION', $this->version);
    }

    public function setConfig()
    {
        $appConfig = [];

        foreach (glob($this->root . '/config/*.php') as $configFile) {
            $file = str_replace($this->root . '/config/', '', $configFile);
            $name = str_replace('.php', '', $file);
            $config = require $configFile;

            $appConfig[$name] = $config;
        }

        $this->configs = $appConfig;

        return $this;
    }

    /**
     * This function registers the default services that Engine needs to run.
     *
     * @return void
     */
    protected function registerDefaultServices()
    {
        $this
            ->register(new ViewServicesProvider)
            ->register(new RouteServicesProvider);
    }

    public function run()
    {
        if(!$this->booted){
            $this->boot();
        }

        $this->slim->run();
    }

    /**
     * Registers a service provider.
     *
     * @param ServiceProviderInterface $provider A ServiceProviderInterface instance
     * @param array                    $values   An array of values that customizes the provider
     *
     * @return Application
     */
    public function register(ServiceProviderInterface $provider, array $values = array())
    {
        $provider->register($this->container);
        foreach ($values as $key => $value) {
            $this->container[$key] = $value;
        }
        $this->providers[] = $provider;
        return $this;
    }

    /**
     * Boots all service providers.
     *
     * This method is automatically called by run(), but you can use it
     * to boot all service providers when not handling a request.
     */
    public function boot()
    {
        if (!$this->booted) {
            foreach ($this->providers as $provider) {
                $provider->boot($this->container);
            }
            $this->booted = true;
        }
    }
}