<?php
namespace p2ee\SilexPartletDemo\SilexProvider;

use rg\injektor\FactoryDependencyInjectionContainer;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class InjektorProvider implements ServiceProviderInterface {

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Container $app) {
        $app['rg.injektor'] = function () use ($app) {
            $configuration = new \rg\injektor\Configuration(
                $app['rg.injektor.config'],
                $app['rg.injector.factories']);
            return new FactoryDependencyInjectionContainer($configuration);
        };
    }
}
