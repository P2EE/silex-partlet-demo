<?php
namespace p2ee\SilexPartletDemo;

use p2ee\Partlets\Partlet;
use p2ee\Preparables\Preparer;
use rg\injektor\DependencyInjectionContainer;

class PartletService {

    /**
     * @var string
     */
    private $baseNamespace;

    /**
     * @var \rg\injektor\DependencyInjectionContainer
     */
    private $dic;

    private $twig;

    private $styles = [];
    protected $jsViews = [];

    /**
     * @param $baseNamespace
     * @param DependencyInjectionContainer $dic
     */
    public function __construct($baseNamespace, DependencyInjectionContainer $dic, $twig) {
        $this->baseNamespace = $baseNamespace;
        $this->dic = $dic;
        $this->twig = $twig;
    }

    public function get($class, $isFullNamespace = false) {
        if (!$isFullNamespace) {
            $class = $this->baseNamespace . '\\' . $class;
        }

        $obj = null;
        if (class_exists($class)) {
            $obj = $this->dic->getInstanceOfClass($class);
        }

        if (!($obj instanceof Partlet)) {
            throw new \RuntimeException('Given class is not a Partlet');
        }
        return $obj;
    }

    public function prepare(Partlet $partlet, $prefills = []) {
        /** @var Preparer $preparer */
        $preparer = $this->dic->getInstanceOfClass(Preparer::class);

        $preparer->prepare($partlet, $prefills);
    }

    public function render(Partlet $partlet) {
        $data = $partlet->getData();
        $renderData = $this->resolveContext($data);
        $renderData['partletId'] = $partlet->getId();

        $style = $partlet->getStyle();
        if($style){
            $this->styles[$style] = $style;
        }
        $view = $partlet->getView();
        if($view){
            $this->jsViews[$partlet->getId()] = [
                'view' => $view,
                'id' => $partlet->getId(),
                'data' => json_encode($partlet->getData())
            ];
        }

        $renderData['GLOBAL_STYLE_LIST'] = $this->styles;
        $renderData['GLOBAL_VIEW_LIST'] = $this->jsViews;
//            'view' => $partlet->getView(),
//            'style' => $partlet->getStyle(),

        return $this->twig->render($partlet->getTemplate(), $renderData);
    }

    protected function resolveContext($data){
        $context = [];
        foreach ($data as $key => $item) {
            if ($item instanceof Partlet) {
                $context[$key] = $this->render($item);
            } else if( is_array($item) ) {
                $context[$key] = $this->resolveContext($item);
            } else {
                $context[$key] = $item;
            }
        }
        return $context;
    }
} 