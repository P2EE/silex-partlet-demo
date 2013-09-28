<?php
namespace p2ee\SilexPartletDemo;

use p2ee\Partlets\Partlet;
use p2ee\SilexPartletDemo\Components\base\Page;

abstract class SilexPartlet extends Partlet {

    public function getContainerPartlet() {
        return Page::class;
    }

    public function getBaseNamespace() {
        return __NAMESPACE__.'\Components';
    }

    public function getRootFolder() {
        return __DIR__.DIRECTORY_SEPARATOR.'Components';
    }

    public function getTemplate() {
        return $this->getFilePart('twig');
    }

    public function getStyle(){
        return $this->getFilePart('css');
    }
}