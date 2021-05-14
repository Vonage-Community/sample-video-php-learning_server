<?php

namespace OTHelloWorld\Action\Archive;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Vonage\Client;

class StopAction
{
    /**
     * @var Client
     */
    protected $vonage;

    public function __construct(ContainerInterface $container)
    {
        $this->vonage = $container->get(Client::class);
    }

    /**
     * @param array<string, string> $args
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $archive = $this->vonage->video()->stopArchive($args['archiveId']);
        
        return new JsonResponse($archive);
    }
}
