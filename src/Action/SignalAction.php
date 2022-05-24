<?php

namespace OTHelloWorld\Action;

use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vonage\Client;

class SignalAction
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
        $data = json_decode($request->getBody()->getContents(), true);
        $sessionId = $data['sessionId'];
        $signalData = 'Signal from server at ' . date('l jS \of F Y h:i:s A');
        $this->vonage->video()->sendSignal($sessionId, 'from-server', $signalData);

        return new EmptyResponse();
    }
}
