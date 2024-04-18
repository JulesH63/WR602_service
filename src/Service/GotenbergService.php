<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GotenbergService
{
    private HttpClientInterface $client;
    private string $gotenbergUrl;

    public function __construct(HttpClientInterface $client, string $gotenbergUrl)
    {
        $this->client = $client;
        $this->gotenbergUrl = $gotenbergUrl;
    }

    public function generatePdfFromHtml(string $htmlContent): string
    {
        $response = $this->client->request('POST', $this->gotenbergUrl, [
            'headers' => [
                'Content-Type' => 'multipart/form-data',
            ],
            'body' => [
                'html' => $htmlContent,
            ],
        ]);

        return $response->getContent();
    }
}
