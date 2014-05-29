<?php
/**
 *
 *
 *
 *
 */

namespace p2ee\SilexPartletDemo\Requirement;

use p2ee\Preparables\Requirement;

class JsonFileRequirement extends Requirement
{

    protected $file;

    protected $jsonElementKey;

    public function __construct($key, $file, $jsonElementKey = null)
    {
        $this->key = $key;
        $this->file = $file;
        $this->jsonElementKey = $jsonElementKey;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getJsonElementKey()
    {
        return $this->jsonElementKey;
    }

    public function isCacheable()
    {
        return false;
    }

    public function getCacheKey()
    {
        return null;
    }
} 