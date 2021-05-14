<?php

namespace OTHelloWorld\Action\Archive;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Vonage\Client;

class StartAction
{
    /**
     * @var Client
     */
    protected $vonage;

    public function __construct(ContainerInterface $container)
    {
        $this->vonage = $container->get(Client::class);
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        $sessionId = $data['sessionId'];
        try {
            $archive = $this->vonage->video()->startArchive($sessionId, ['name' => 'Getting Started Sample Archive']);
        } catch (\Exception $e) {
            if ($e->getCode() === 404) {
                return new JsonResponse([
                    'type' => 'https://developer.vonage.com/errors/video#no-clients-for-archive',
                    'description' => 'Cannot start archive, there are currently no clients connected',
                    'status' => 400,
                    'detail' => 'Archives cannot begin without at least one client connected. Please try again later once you have confirmed a client is actively connected to the session'
                ], 400);
            }

            if ($e->getCode() === 409) {
                return new JsonResponse([
                    'type' => 'https://developer.vonage.com/errors/video#archive-already-started',
                    'description' => 'Cannot start archive, there is already an archive being recorded',
                    'status' => 409,
                    'detail' => 'Only a single archive operation can be running per session. Please wait until the current archiving operation has stopped.'
                ], 409);
            }
        }
        

        return new JsonResponse($archive);
    }
}
