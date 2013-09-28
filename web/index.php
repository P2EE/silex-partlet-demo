<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/p2ee/SilexPartletDemo/Components',
));

$app->register(new \p2ee\SilexPartletDemo\SilexProvider\InjektorProvider(), [
    'rg.injektor.config' => __DIR__.'/../src/p2ee/SilexPartletDemo/config/dic_config.php',
    'rg.injector.factories' => __DIR__.'/../generated/'
]);

$app->register(new p2ee\SilexPartletDemo\SilexProvider\PartletServiceProvider(), [
    'partlets.baseNamespace' => '\p2ee\SilexPartletDemo\Components',
]);

$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    return new \Symfony\Component\HttpFoundation\Response($message);
});

$app->get('/style/{name}', function($name) use ($app){
    $file = __DIR__.'/../src/p2ee/SilexPartletDemo/Components/'.$name;
    if(!file_exists($file)){
        return $app->abort(404, 'The style was not found.');
    }

    $stream = function () use ($file) {
        readfile($file);
    };

    return $app->stream($stream, 200, array('Content-Type' => 'text/css'));
})->assert('name', '(.*).css');

$app->get('/js/{name}', function($name) use ($app){
    $file = __DIR__.'/../src/p2ee/SilexPartletDemo/Components/'.$name;
    if(!file_exists($file)){
        return $app->abort(404, 'The javascript file was not found.');
    }

    $stream = function () use ($file) {
        readfile($file);
    };

    return $app->stream($stream, 200, array('Content-Type' => 'application/javascript'));
})->assert('name', '(.*).js');


$app->get('/assets/{name}', function($name) use ($app){
    $file = __DIR__.'/assets/'.$name;
    if(!file_exists($file)){
        return $app->abort(404, 'The requests file was not found.');
    }

    $stream = function () use ($file) {
        readfile($file);
    };

    return $app->stream($stream, 200);
})->assert('name', '(.*)');

$app->get('/{name}', function ($name) use ($app) {
    $parts = explode('/', $name);
    $filePart = array_pop($parts);
    $classParts = explode('.',$filePart);
    $class = array_shift($classParts);

    $partlet = ltrim(implode('\\',$parts).'\\'.$class, '\\');

    /** @var \p2ee\Partlets\Partlet $partlet */
    try {
        $partlet = $app['partlet']->get($partlet);
    } catch (\Exception $e) {
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    $container = $app['partlet']->get($partlet->getContainerPartlet(), true);
    $app['partlet']->prepare($partlet);
    $app['partlet']->prepare($container, ['content' => $partlet]);

    return $app['partlet']->render($container);
})->value('name', 'home/Home.html')
    ->assert('name', '.{1,}');

$app->run();