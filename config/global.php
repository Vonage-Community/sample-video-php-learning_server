<?php

use ICanBoogie\Storage\FileStorage;
use Psr\Container\ContainerInterface;
use Vonage\Client;
use Vonage\Client\Credentials\Keypair;
use Vonage\Video\ClientFactory;

return [
    'config' => [
        'vonage' => [
            'key_path' => getenv('VONAGE_PRIVATE_KEY'),
            'application_id' => getenv('VONAGE_APPLICATION_ID'),
        ],
        'views_dir' =>__DIR__ . '/../templates',
        'storage_dir' => __DIR__ . '/../storage'
    ],

    // IMPORTANT: storage is a variable that associates room names with unique unique sesssion IDs. 
    // For simplicty, we use a extension called FileStorage to implement this logic.
    // Generally speaking, a production application chooses a database system like MySQL, MongoDB, or Redis etc.
    // The FileStorage transforms into a file where the name is a room name and its value is session ID.
    'storage' => DI\Factory(function(ContainerInterface $c) {
        return new FileStorage($c->get('config')['storage_dir']);
    }),

    Client::class => function(ContainerInterface $c) {
        $vonageConfig = $c->get('config')['vonage'];
        $client = new Client(new Keypair(file_get_contents($vonageConfig['key_path']), $vonageConfig['application_id']));
        $client->getFactory()->set('video', new ClientFactory());

        return $client;
    }
];
