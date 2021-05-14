<?php

namespace OTHelloWorld\Action;

use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EventsAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []) : ResponseInterface
    {
        error_log($args['type'] . '---' . $request->getBody()->getContents());
        return new EmptyResponse();
    }
}
