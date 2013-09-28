<?php
namespace p2ee\SilexPartletDemo\InjectorProvider;

use rg\injektor\Provider;
use Symfony\Component\HttpFoundation\Request;

/**
 * @service
 */
class CurrentRequestProvider implements Provider {

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    public function __construct() {
    }

    private function build() {
        if ($this->request) {
            return;
        }
        $this->request = Request::createFromGlobals();
    }

    public function get() {
        $this->build();
        return $this->request;
    }
}