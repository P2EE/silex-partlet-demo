<?php
namespace p2ee\SilexPartletDemo\Components\content;

use p2ee\BaseRequirements\Requirements\RequestDataRequirement;
use p2ee\SilexPartletDemo\SilexPartlet;

class NewsItem extends SilexPartlet{

    protected $title;
    protected $text;

    public function collect() {
        yield [
            new RequestDataRequirement('title'),
            new RequestDataRequirement('text'),
        ];
    }

    public function getData(){
        return [
            'title' => $this->title,
            'text' => $this->text,
        ];
    }
}