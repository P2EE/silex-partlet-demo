<?php
namespace p2ee\SilexPartletDemo\SilexProvider;

use p2ee\SilexPartletDemo\PartletService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class PartletServiceProvider implements ServiceProviderInterface {

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Container $app) {
        $app['partlet'] = function () use ($app) {
            return new PartletService($app['partlets.baseNamespace'], $app['rg.injektor'], $app['twig']);
        };
    }
}
