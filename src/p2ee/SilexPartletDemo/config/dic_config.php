<?php

return array(
    Symfony\Component\HttpFoundation\Request::class => [
        'provider' => [
            'class' => \p2ee\SilexPartletDemo\InjectorProvider\CurrentRequestProvider::class
        ]
    ],
    \p2ee\Preparables\Preparer::class => [
        'provider' => [
            'class' => \p2ee\SilexPartletDemo\InjectorProvider\PreparerProvider::class
        ]
    ]
);