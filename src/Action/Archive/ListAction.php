<?php

namespace OTHelloWorld\Action\Archive;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Vonage\Client;
use Vonage\Entity\Filter\KeyValueFilter;

class ListAction
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
        $query = $request->getQueryParams();
        $offset = $query['offset'] ?? 0;
        $count = $query['count'] ?? 1000;
        $archiveList = $this->vonage->video()->listArchives(new KeyValueFilter(['offset' => $offset, 'count' => $count]));

        $result = [];
        foreach ($archiveList as $archive) {
            $result[] = $archive->toArray();
        }

        return new JsonResponse($result);
    }
}
