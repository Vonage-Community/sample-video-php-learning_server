<?php

namespace OTHelloWorld\Action;

use Vonage\Client;
use Vonage\Video\MediaMode;
use ICanBoogie\Storage\FileStorage;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Vonage\Video\SessionOptions;

class RoomAction
{
    /**
     * @var string
     */
    protected $applicationId;

    /**
     * @var Client
     */
    protected $vonage;

    /**
     * @var FileStorage<string>
     */
    protected $storage;

    public function __construct(ContainerInterface $container)
    {
        $this->applicationId = $container->get('config')['vonage']['application_id'];
        $this->vonage = $container->get(Client::class);
        $this->storage = $container->get('storage');
    }

    /**
     * @param array<string, string> $args
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $name = $args['name'];
        // if a room name is already associated with a session ID
        if ($this->storage->exists($name)) {
            // fetch the sessionId from local storage
            $sessionId = $this->storage[$name];

            // generate token
            $token = $this->vonage->video()->generateClientToken($sessionId);
            $responseData = [
                'applicationId' => $this->applicationId,
                'sessionId' => $sessionId,
                'token'=>$token
            ];

            return new JsonResponse($responseData);
        } else { // Generate a new session and store it off
            $session = $this->vonage->video()->createSession(
                new SessionOptions(
                    ['mediaMode' => MediaMode::ROUTED]
                )
            );

            // store the sessionId into local
            $this->storage[$name] = $session->getSessionId();
            
            // generate token
            $token = $this->vonage->video()->generateClientToken($session->getSessionId());
            $responseData = [
                'applicationId' => $this->applicationId,
                'sessionId' => $session->getSessionId(),
                'token'=>$token
            ];

            return new JsonResponse($responseData);
        }
    }
}
