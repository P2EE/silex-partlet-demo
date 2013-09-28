<?php
namespace p2ee\SilexPartletDemo\Components\home;

use p2ee\Partlets\PartletRequirement;
use p2ee\SilexPartletDemo\Components\content\News;
use p2ee\SilexPartletDemo\SilexPartlet;

class Home extends SilexPartlet {

    protected $block;

    public function collect() {
        yield [
            new PartletRequirement(
                'block',
                News::class
            )
        ];
    }

    public function getData() {
        return [
            'block' => $this->block
        ];
    }
}