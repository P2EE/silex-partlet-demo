<?php
namespace p2ee\SilexPartletDemo\InjectorProvider;

use p2ee\BaseRequirements\Requirements\RequestDataRequirement;
use p2ee\BaseRequirements\Requirements\ServiceRequirement;
use p2ee\BaseRequirements\Resolvers\RequestDataResolver;
use p2ee\BaseRequirements\Resolvers\ServiceResolver;
use p2ee\Partlets\PartletRequirement;
use p2ee\Partlets\PartletResolver;
use p2ee\Preparables\Preparer;
use p2ee\SilexPartletDemo\Requirement\JsonFileRequirement;
use p2ee\SilexPartletDemo\Resolver\JsonFileResolver;
use rg\injektor\Provider;

/**
 * @service
 */
class PreparerProvider implements Provider {

    protected $preparer;
    /**
     * @var
     */
    private $serviceResolver;
    /**
     * @var
     */
    private $requestDataResolver;
    /**
     * @var \p2ee\Partlets\PartletResolver
     */
    private $partletResolver;
    /**
     * @var \p2ee\SilexPartletDemo\Resolver\JsonFileResolver
     */
    private $jsonFileResolver;

    /**
     * @inject
     * @param ServiceResolver $serviceResolver
     * @param RequestDataResolver $requestDataResolver
     * @param PartletResolver $partletResolver
     */
    public function __construct(
        ServiceResolver $serviceResolver,
        RequestDataResolver $requestDataResolver,
        PartletResolver $partletResolver,
        JsonFileResolver $jsonFileResolver
    ) {
        $this->serviceResolver = $serviceResolver;
        $this->requestDataResolver = $requestDataResolver;
        $this->partletResolver = $partletResolver;
        $this->jsonFileResolver = $jsonFileResolver;
    }

    private function build() {
        if ($this->preparer) {
            return;
        }
        $this->preparer = new Preparer([
            ServiceRequirement::class => $this->serviceResolver,
            RequestDataRequirement::class => $this->requestDataResolver,
            PartletRequirement::class => $this->partletResolver,
            JsonFileRequirement::class => $this->jsonFileResolver,
            ]);
    }

    public function get() {
        $this->build();
        return $this->preparer;
    }
}