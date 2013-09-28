<?php
namespace p2ee\SilexPartletDemo\SilexProvider;

use p2ee\SilexPartletDemo\PartletService;
use Silex\Application;
use Silex\ServiceProviderInterface;

class PartletServiceProvider implements ServiceProviderInterface {

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app) {
        $app['partlet'] = $app->share(function () use ($app) {
            return new PartletService($app['partlets.baseNamespace'], $app['rg.injektor'], $app['twig']);
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app) {

    }
}