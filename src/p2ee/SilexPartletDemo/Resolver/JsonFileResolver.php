<?php
/**
 *
 *
 *
 *
 */

namespace p2ee\SilexPartletDemo\Resolver;

use p2ee\Preparables\Preparer;
use p2ee\Preparables\Requirement;
use p2ee\Preparables\Resolver;
use p2ee\SilexPartletDemo\Requirement\JsonFileRequirement;

class JsonFileResolver implements Resolver
{

    /**
     * @param Requirement|JsonFileRequirement $requirement
     *
     * @return mixed
     */
    public function resolve(Requirement $requirement)
    {
        $result = json_decode(file_get_contents($requirement->getFile()), true);

        $key = $requirement->getJsonElementKey();
        if ($key !== null) {
            $result = $result[$key];
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getSupportedType()
    {
        return JsonFileRequirement::class;
    }
} 