<?php
namespace p2ee\SilexPartletDemo\SilexProvider;

use rg\injektor\FactoryDependencyInjectionContainer;
use Silex\Application;
use Silex\ServiceProviderInterface;

class InjektorProvider implements ServiceProviderInterface {

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app) {
        $app['rg.injektor'] = $app->share(function () use ($app) {
            $configuration = new \rg\injektor\Configuration(
                $app['rg.injektor.config'],
                $app['rg.injector.factories']);
            return new FactoryDependencyInjectionContainer($configuration);
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
        // TODO: Implement boot() method.
    }
}