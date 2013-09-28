<?php
namespace p2ee\SilexPartletDemo\Components\base;

use p2ee\BaseRequirements\Requirements\RequestDataRequirement;
use p2ee\SilexPartletDemo\SilexPartlet;

class Page extends SilexPartlet {

    /**
     * @var string
     */
    protected $content;

    public function collect() {
        yield [
            new RequestDataRequirement('content')
        ];
    }

    public function getData() {
        return [
            'content' => $this->content
        ];
    }
}