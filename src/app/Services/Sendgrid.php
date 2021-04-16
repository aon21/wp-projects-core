<?php

namespace Prophe1\WPProjectsCore\Services;

use GuzzleHttp\Client;

class Sendgrid
{
    /**
     * @var string
     */
    private $apiRoute = 'https://api.sendgrid.com/v3/';

    /**
     * @var Client
     */
    private $client;

    /**
     * Sendgrid constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if (! $this->getApiKey()) {
            throw new \Exception('Invalid Sendgrid API key!');
        }

        $clientParams = [
            'base_uri' => $this->getApiRoute(),
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->getApiKey())
            ]
        ];

        $this->client = new Client($clientParams);
    }

    /**
     * @return string
     */
    public function getApiRoute()
    {
        return $this->apiRoute;
    }

    /**
     * @return bool|mixed|string
     */
    public function getApiKey()
    {
        return env('SENDGRID_API_KEY');
    }

    /**
     * @param array $listIds
     * @param array $contacts
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addContacts(array $listIds, array $contacts)
    {
        $dataParams = [
            'list_ids' => $listIds,
            'contacts' => $contacts
        ];

        return $this->client->put('marketing/contacts', [
            'json' => $dataParams
        ]);
    }
}
