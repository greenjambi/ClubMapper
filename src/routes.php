<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {

    return $this->renderer->render($response, 'index.phtml');
});

$app->get('/view-on-map', function (Request $request, Response $response, array $args) {
    return $this->renderer->render($response, 'viewOnMap.phtml');
});