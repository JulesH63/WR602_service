<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GotenbergService
{
    private $client;
    private $gotenbergBaseUrl;

    public function __construct(HttpClientInterface $client, string $gotenbergBaseUrl)
    {
        $this->client = $client;
        $this->gotenbergBaseUrl = $gotenbergBaseUrl;
    }

    public function generatePdfFromUrl(string $url): string
    {
        $response = $this->client->request(
            'POST',
            $this->gotenbergBaseUrl . '/forms/chromium/convert/url',
            [
                'headers' => [
                    'Content-Type' => 'multipart/form-data',
                ],
                'body' => [
                    'url' => $url
                ]
            ]
        );

        return $response->getContent();
    }
}
