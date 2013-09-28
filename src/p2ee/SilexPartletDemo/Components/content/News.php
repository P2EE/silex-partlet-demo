<?php
namespace p2ee\SilexPartletDemo\Components\content;

use p2ee\Partlets\PartletRequirement;
use p2ee\SilexPartletDemo\SilexPartlet;

class News extends SilexPartlet {

    protected $newsItems = [];

    public function collect() {
        yield [
            new PartletRequirement(
                'newsItems',
                NewsItem::class,
                [
                    'title' => 'News 1',
                    'text' => 'Lorem ipsum',
                ]
            )
        ];
    }

    public function getData() {
        return [
            'newslist' => $this->newsItems
        ];
    }
}